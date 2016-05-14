<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('User');
		$this->load->library("form_validation");
	}

	public function index() {
		//login and reg - create view
		$this->load->view('welcome');
	}

	public function interestCount($array) {
		if(count($array) > 3){
			return false;
		}
		return true;
	}

	public function process_register() {
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|required|matches[confirm_password]|md5');
	 	$this->form_validation->set_rules('confirm_password', 'Confirm_Password', 'trim|required|md5');
		$this->form_validation->set_rules('interest', 'CATEGORIES', 'callback_interestCount');
		$this->form_validation->set_message('interestCount', 'You can only select up to 3 items from category.');

		if($this->form_validation->run() === FALSE) {
		$this->session->set_flashdata("registration_error", validation_errors());
		redirect('signin');
		 } else {
	   $new_user = $this->input->post(NULL, TRUE);
		 $user = $this->User->get_user($new_user);

			if($user) {
				$this->session->set_flashdata("registration_error", "The email is already registered, please go to log in.");
				redirect('signin');
			} else {
				$add_user = $this->User->add_user($new_user);
				if($add_user){
					$get_user_by_id = $this->User->get_user($new_user);
					$add_interest = $this->User->add_interest($get_user_by_id, $new_user);
					if($add_interest){
						redirect('signin');
					}
					else{
						echo "Upading user data for interests failed!";
					}
				}
				else {
					echo "Updating user data failed!";
				}
			}
		}
		redirect('signin');
	}

	public function script() {
		$this->load->view('script');
	}

	public function signin() {
		$this->load->view('signin');
	}

	public function process_signin() {
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email", "Email", "trim|valid_email|required");
		$this->form_validation->set_rules("password", "Password", "trim|required|md5");

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata("loggin_error", validation_errors());
			redirect('signin');
		} else {
			$this->load->model('User');
			$existing_user = $this->input->post(NULL, TRUE);
			$user = $this->User->get_user_login($existing_user);
			$interests = $this->User->get_interests($user);
			if($user && $user['password'] == $existing_user['password']) {
					$this->session->set_userdata('login_info', $user);
					$this->session->set_userdata('interest_info', $interests);
					$this->display_show_products();
			} else {
				$this->session->set_flashdata("loggin_error", "No such user, please go to registration.");
				redirect('signin');
			}
		}
	}

	public function display_show_products() {
		//get the relevant products from db for the user_id
		if(isset($this->session->userdata['login_info']['id']) && $this->session->userdata['login_info']['id'] != null){
			$user_products = $this->User->get_products($this->session->userdata['login_info']['id']);
			$display_cart = $this->User->get_cart($this->session->userdata['login_info']['id']);
			$this->load->view('show_products', ['user_products'=>$user_products, 'show_cart'=>$display_cart]);
		}
		else{
			$user_products = $this->User->get_all_products();
			$this->load->view('show_products', ['user_products'=>$user_products]);
		}
	}

	public function stock_check() {
    $stock = $this->input->post('stock');
    $quantity_ordered = $this->input->post('quantity');
		if($stock >= $quantity_ordered) {
      return true;
    }
    return false;
  }

  public function add_to_cart_process() {
    $this->form_validation->set_rules('quantity', 'Orderd quantity', 'trim|required|callback_stock_check');
		$this->form_validation->set_message('stock_check', 'You entered a number larger than the item left.');
    if($this->form_validation->run() === FALSE) {
      $this->session->set_flashdata("order_error", validation_errors());
      // $this->display_show_products();
			redirect('/display_show_products');
    }
		else {
      $cart_data= $this->input->post(NULL,TRUE);
      $order = $this->User->add_to_cart($this->input->post());
			$deduct_stock = $this->User->deduct_stock($this->input->post());
			$item = $this->User->get_product_by_id($this->input->post('product_id'));
			echo json_encode($item);
			// redirect('/display_show_products');
  	}
	}

	public function display_cart(){
		$display_cart = $this->User->get_cart($this->session->userdata['login_info']['id']);
		echo json_encode($display_cart);
	}

	public function checkout($id) {
		$display_cart = $this->User->get_cart($id);
		$this->load->view('checkout', ['cart'=>$display_cart]);
	}

	public function empty_cart($id) {
		$this->User->empty_cart($id);
		redirect('/users/display_show_products');
	}

	public function new_user() {
		$this->load->view('new');
	}

	public function logout() {
		$this->session->sess_destroy();
	  redirect('/');
	}
}
