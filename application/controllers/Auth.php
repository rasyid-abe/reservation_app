<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            if ($this->session->userdata('email')) {
                redirect('statistic');
            }
            $data = array();
            $data['header_title'] = "Login";
            $this->template->content("auth/login", $data);
            $this->template->show('template/login');
        } else {
            if (getFunction()) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Error!</h6>
                System Expired!
                </div>
                ');
                redirect('auth');
            } else {
                $this->_login();
            }
        }
    }

    public function store_history($id, $act, $desc)
    {
        $data = [
            'id_user' => $id,
            'aktivitas' => $act,
            'keterangan' => $desc,
        ];

        $this->db->insert('history', $data);
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id_user' => $user['id_user'],
                        'username' => $user['username'],
                        'role_id' => $user['role_id'],
                    ];

                    $this->store_history($user['id_user'], "Login", "Login ke sistem");

                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('root/home');
                    } elseif ($user['role_id'] == 2) {
                        redirect('admin/home_adm');
                    } elseif ($user['role_id'] == 3) {
                        redirect('doctor/home_doc');
                    } elseif ($user['role_id'] == 4) {
                        redirect('client/home_kl');
                    }
                } else {
                    $this->session->set_flashdata('message', '
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h6><i class="icon fa fa-check"></i> Error!</h6>
                    Password Salah.
                    </div>
                    ');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h6><i class="icon fa fa-check"></i> Error!</h6>
                Akun belum aktif.
                </div>
                ');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6><i class="icon fa fa-check"></i> Error!</h6>
            Akun belum terdaftar.
            </div>
            ');
            redirect('auth');
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60*60*24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '
                    <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Aktivasi Berhasil!</h4>
                    Akun anda ('.$email.') telah diaktifkan. Silahkan Login.
                    </div>
                    ');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Aktivasi Gagal!</h4>
                    Token Kadaluarsa.
                    </div>
                    ');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Aktivasi Gagal!</h4>
                Token Salah.
                </div>
                ');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Aktivasi Gagal!</h4>
            Email Salah.
            </div>
            ');
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[repassword]', [
            'matches' => 'Password tidak cocok!'
        ]);
        $this->form_validation->set_rules('repassword', 'Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == false) {
            if ($this->session->userdata('email')) {
                redirect('statistic');
            }
            $data = array();
            $data['header_title'] = "Registration";
            $this->template->content("auth/registration", $data);
            $this->template->show('template/login');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
                'image' => 'default.png',
                'role_id' => 4,
                'is_active' => 0,
                'created_by' => 0,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $insert_id = $this->db->insert_id();

            $data_klien = [
                'id_user' => $insert_id,
            ];

            $this->db->insert('klien', $data_klien);

            //siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user_token', $user_token);

            //kirim Email
            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Selamat!</h4>
            Akun anda berhasil dibuat. Cek email anda untuk aktivasi akun sebelum login.
            </div>
            ');
            redirect('auth');
        }
    }

    public function forgot_password()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data = array();
            $data['header_title'] = "Lupa Password";
            $this->template->content("auth/forgot_password", $data);
            $this->template->show('template/login');
        } else {
            $email = $this->input->post('email', true);
            $username = $this->input->post('username', true);
            $user = $this->db->get_where('user', ['email' => $email, 'username' => $username, 'is_active' => 1])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);

                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                Silahkan cek email anda untuk reset password.
                </div>
                ');
                redirect('auth/forgot_password');
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Gagal!</h4>
                Email atau username ini tidak terdaftar atau belum aktif!
                </div>
                ');
                redirect('auth/forgot_password');
            }
        }
    }

    public function reset_password()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->change_password();
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Reset failed!</h4>
                Token Salah.
                </div>
                ');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Reset failed!</h4>
            Email salah.
            </div>
            ');
            redirect('auth');
        }
    }

    public function change_password()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[repassword]');
        $this->form_validation->set_rules('repassword', 'Repeat Password', 'trim|required|min_length[6]|matches[password]');

        if ($this->form_validation->run() == false) {
            $data = array();
            $data['header_title'] = "Change Password";
            $this->template->content("auth/change_password", $data);
            $this->template->show('template/login');
        } else {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $id_user = $this->db->get_where('user', ['email' => $email])->row('id_user');
            $this->store_history($id_user, "Reset Password", "Menggunakan fitur lupa password.");

            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            Password berhasil diubah. Silahkan Login.
            </div>
            ');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $this->load->library('email');

        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'acidnain72@gmail.com'; // isi email google
        $config['smtp_pass'] = 'Qwert!2345'; // ini password email google
        $config['smtp_port'] = 465;
        $config['crlf'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';

        $this->email->initialize($config);

        $this->email->set_newline("\r\n");
        $this->email->from('acidnain72@gmail.com', 'Grha Petcare');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('
            Click this link to verify your account :
            <a href="' . base_url() .'auth/verify?email='. $this->input->post('email') .'&token='.urlencode($token).'">Activate</a>
            ');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('
            Click this link to reset your password :
            <a href="' . base_url() .'auth/reset_password?email='. $this->input->post('email') .'&token='.urlencode($token).'">Reset Password</a>
            ');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        redirect('auth');
    }
    }
