<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('tanggal_helper');
    }

    private function _get_current_domain()
    {
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $host = explode(':', $host)[0];
        $host = str_replace('www.', '', $host);
        return trim(strtolower($host));
    }

    public function index()
    {
        // Jika sudah login redirect ke dashboard
        if ($this->session->userdata('logged_in') || $this->session->userdata('id')) {
            redirect('dashboard/profile');
            return;
        }

        $host = $this->_get_current_domain();

        // Ambil data domain
        $domain = $this->db->get_where('table_domain', [
            'domain_name' => $host,
            'is_active'   => 1
        ])->row_array();

        if (!$domain) {
            show_404();
            return;
        }

        $data['domain']      = $domain;
        $data['menu_header'] = $this->Menu_model->get_parent($domain['id']);

        // Tampilkan view login admin
        $this->load->view('adminlte/login', $data);
    }




    public function register()
    {
        // Jika sudah login redirect ke dashboard
        if ($this->session->userdata('logged_in') || $this->session->userdata('id')) {
            redirect('dashboard/profile');
            return;
        }

        $host = $this->_get_current_domain();

        // Ambil data domain
        $domain = $this->db->get_where('table_domain', [
            'domain_name' => $host,
            'is_active'   => 1
        ])->row_array();

        if (!$domain) {
            show_404();
            return;
        }

        $data['domain'] = $domain;

        // Tampilkan view register admin
        $this->load->view('adminlte/register', $data);
    }

    public function proses_register()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email sudah terdaftar! Silakan gunakan email lain.'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|min_length[8]', [
            'min_length' => 'Password minimal harus 8 karakter.'
        ]);
        $this->form_validation->set_rules('password2', 'Retype Password', 'required|matches[password1]', [
            'matches' => 'Konfirmasi password tidak cocok dengan password.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => 'error',
                'message' => validation_errors()
            ]);
            return;
        }

        $nama     = $this->input->post('nama', true);
        $email    = $this->input->post('email', true);
        $password = $this->input->post('password1', true);
        $host     = $this->_get_current_domain();

        $domain = $this->db->get_where('table_domain', ['domain_name' => $host])->row_array();
        $domain_id = $domain ? $domain['id'] : 1;

        $otp_code = sprintf("%06d", mt_rand(1, 999999));
        $otp_expired = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        $data_user = [
            'id_domain'   => $domain_id,
            'username'    => $nama,
            'email'       => $email,
            'password'    => password_hash($password, PASSWORD_DEFAULT),
            'otp'    => $otp_code,
            'otp_expired' => $otp_expired,
            'active'   => 0,
            'date_created'  => date('Y-m-d H:i:s')
        ];

        $insert = $this->db->insert('users', $data_user);

        if ($insert) {
            $send_mail = $this->_send_otp_email($email, $nama, $otp_code);

            if ($send_mail) {
                $this->session->set_userdata('otp_email', $email);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Registrasi berhasil! Kode OTP telah dikirim ke email Anda.',
                    'redirect' => base_url('admin/verifikasi_otp_view')
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal mengirim email OTP. Silakan coba beberapa saat lagi.'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal mendaftarkan akun, silakan coba lagi.'
            ]);
        }
    }

    private function _send_otp_email($email, $nama, $otp_code)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://mail.optimadigitalsolution.com',
            'smtp_port' => 465,
            'smtp_user' => 'admin@optimadigitalsolution.com',
            'smtp_pass' => 'Admin123Rahasia@',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
            'crlf'      => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('admin@optimadigitalsolution.com', 'Aktivasi Akun');
        $this->email->to($email);
        $this->email->subject('Kode Verifikasi OTP Pendaftaran Akun');

        $message = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <style>
            body { font-family: Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 0; }
            .email-container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
            .email-header { background: #007bff; color: #ffffff; text-align: center; padding: 25px; }
            .email-body { padding: 30px; color: #333333; line-height: 1.6; }
            .otp-box { background: #e9ecef; color: #007bff; font-size: 32px; font-weight: bold; text-align: center; letter-spacing: 6px; padding: 15px; margin: 20px 0; border-radius: 6px; }
            .email-footer { background: #f4f6f9; color: #777777; text-align: center; padding: 15px; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="email-header">
                <h2>Verifikasi Akun Anda</h2>
            </div>
            <div class="email-body">
                <p>Halo <strong>' . $nama . '</strong>,</p>
                <p>Terima kasih telah mendaftar. Untuk menyelesaikan proses pendaftaran, silakan gunakan kode verifikasi (OTP) di bawah ini:</p>
                <div class="otp-box">' . $otp_code . '</div>
                <p>Kode ini hanya berlaku selama <strong>15 menit</strong> ke depan. Jangan berikan kode ini kepada siapa pun.</p>
                <p>Jika Anda tidak merasa melakukan pendaftaran ini, abaikan saja email ini.</p>
            </div>
            <div class="email-footer">
                &copy; ' . date('Y') . ' Optima Digital Solution. All rights reserved.
            </div>
        </div>
    </body>
    </html>';

        $this->email->message($message);

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function verifikasi_otp_view()
    {
        $email = $this->session->userdata('otp_email');
        if (!$email) {
            redirect('admin/register');
        }

        $host = $this->_get_current_domain();
        $domain = $this->db->get_where('table_domain', ['domain_name' => $host])->row_array();

        $data['domain'] = $domain;
        $data['email']  = $email;

        $this->load->view('adminlte/verify_otp', $data);
    }

    public function verify_otp_proses()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $email = $this->input->post('email', true);
        $otp   = $this->input->post('otp', true);

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if (!$user) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Akun tidak ditemukan.'
            ]);
            return;
        }

        if ($user['active'] == 1) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Akun sudah aktif sebelumnya. Silakan login.',
                'redirect' => base_url('admin')
            ]);
            return;
        }

        if ($user['otp'] !== $otp) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Kode OTP salah!'
            ]);
            return;
        }

        if (strtotime(date('Y-m-d H:i:s')) > strtotime($user['otp_expired'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Kode OTP kedaluwarsa. Silakan minta kode baru.'
            ]);
            return;
        }

        $update = $this->db->where('email', $email)->update('users', [
            'active'   => 1,
            'otp'    => null,
            'otp_expired' => null
        ]);

        if ($update) {
            $this->session->unset_userdata('otp_email');
            echo json_encode([
                'status' => 'success',
                'message' => 'Verifikasi berhasil! Silakan login.',
                'redirect' => base_url('admin')
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal memverifikasi akun.'
            ]);
        }
    }

    public function resend_otp()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $email = $this->input->post('email', true);
        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if (!$user) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Email tidak terdaftar.'
            ]);
            return;
        }

        $otp_code = sprintf("%06d", mt_rand(1, 999999));
        $otp_expired = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        $this->db->where('email', $email)->update('users', [
            'otp'    => $otp_code,
            'otp_expired' => $otp_expired
        ]);

        $send_mail = $this->_send_otp_email($email, $user['username'], $otp_code);

        if ($send_mail) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Kode OTP baru telah dikirim ke email Anda.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal mengirim ulang OTP.'
            ]);
        }
    }

    public function verifikasi_otp()
    {
        // Pastikan request melalui AJAX
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $email = $this->input->post('email', true);
        $otp   = $this->input->post('otp', true);

        // Cari user berdasarkan email
        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if (!$user) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Akun dengan email tersebut tidak ditemukan.'
            ]);
            return;
        }

        // Cek jika akun sudah aktif
        if ($user['active'] == 1) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Akun sudah aktif sebelumnya. Silakan login.'
            ]);
            return;
        }

        // Validasi kecocokan kode OTP
        if ($user['otp'] !== $otp) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Kode OTP yang Anda masukkan salah.'
            ]);
            return;
        }

        // Validasi masa berlaku OTP (expired)
        if (strtotime(date('Y-m-d H:i:s')) > strtotime($user['otp_expired'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Kode OTP telah kedaluwarsa. Silakan minta kirim ulang OTP.'
            ]);
            return;
        }

        // Update status user menjadi aktif dan kosongkan kolom OTP
        $update = $this->db->where('email', $email)->update('users', [
            'active'   => 1,
            'otp'    => null,
            'otp_expired' => null
        ]);

        if ($update) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Verifikasi berhasil! Akun Anda telah aktif, silakan login.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal memverifikasi akun, silakan coba lagi.'
            ]);
        }
    }



    public function forgot_password()
    {
        $this->load->view('adminlte/forgot_password');
    }

    public function proses_login()
    {
        $username = $this->input->post('email');
        $password = $this->input->post('password');

        $host = $this->_get_current_domain();

        $domain = $this->db->get_where('table_domain', [
            'domain_name' => $host,
            'is_active'   => 1
        ])->row();

        if (!$domain) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Domain tidak dikenali!'
            ]);
            return;
        }

        // Cek User
        $user = $this->User_model->check_login($username);

        if ($user) {
            // Cek Domain User
            if ($user['id_domain'] != $domain->id) {
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Akun tidak terdaftar di domain ini!'
                ]);
                return;
            }

            // Cek Status Aktif
            if ($user['active'] != 1) {
                echo json_encode([
                    'status'  => 'inactive',
                    'message' => 'Akun belum aktif! Silakan verifikasi OTP terlebih dahulu.',
                    'email'   => $user['email']
                ]);
                return;
            }

            // Cek Password
            if (password_verify($password, $user['password'])) {
                $this->session->set_userdata([
                    'id'        => $user['id_users'],
                    'username'  => $user['username'],
                    'email'     => $user['email'],
                    'id_domain' => $user['id_domain'],
                    'role'      => $user['role'],
                    'logged_in' => true,
                    'is_admin' => $user['is_admin']
                ]);

                echo json_encode([
                    'status'  => 'success',
                    'message' => 'Login berhasil',
                    'nama'    => $user['username'],
                    'salam'   => waktu()
                ]);
            } else {
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Password Salah!'
                ]);
            }
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Email tidak terdaftar!'
            ]);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin');
    }
}
