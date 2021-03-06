<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function index() {
        $data['title'] = 'Categories';

        $data['categories'] = $this->category_model->get_categories();

        $this->load->view('templates/header');
        $this->load->view('categories/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = 'Create Category';

        // Form Validation 
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('categories/create', $data);
            $this->load->view('templates/footer');
        } else {
            $this->category_model->create_category();
            redirect('categories');
        }
    }

    public function posts($id) {
        $data['title'] = $this->category_model->get_categories_by_id($id)->name;

        $data['posts'] = $this->post_model->get_posts_by_category($id);

        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');
    }
}
