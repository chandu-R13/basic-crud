<?php
class CarModel extends CI_controller{

    /* This method will show car listing page */
    function index() {
        $this->load->model('Car_model');
        $rows = $this->Car_model->all();
        $data['rows'] = $rows;
        $this->load->view('car_model/list.php',$data);
    }

    function filterCars() {
        $filter = $this->input->post();
        $this->load->model('Car_model');
            $rows = $this->Car_model->all($filter["filterType"],$filter["search"]);
            $data['rows'] = $rows;
            $this->load->view('car_model/list.php',$data);
    }

    function showCreateForm() {
        $html = $this->load->view('car_model/create.php','',true);
        $response['html'] = $html;
        echo json_encode($response);
    }

    function saveModel(){

        $this->load->model('Car_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('color','Color','required');
        // $this->form_validation->set_rules('price','Price','required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');

        if($this->form_validation->run() == true) {
            //save enteries to DB

            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['color'] = $this->input->post('color');
            $formArray['transmission'] = $this->input->post('transmission');
            $formArray['price'] = $this->input->post('price');
            $formArray['created_at'] = date('Y-m-d H:i:s');           
            $id = $this->Car_model->create($formArray);


            $row = $this->Car_model->getRow($id);
            $vData['row'] = $row;
            $rowHtml = $this->load->view('car_model/car_row',$vData,true);

            $response['row'] = $rowHtml;
            $response['status'] = 1;
            $response['message'] ="<div class=\"alert alert-success\">Record has been added successfully.</div>";
        } else {

            $response['status'] = 0;
            $response['name'] = strip_tags(form_error('name'));
            $response['color'] = strip_tags(form_error('color'));
            $response['price'] = strip_tags(form_error('price'));
            // return error messages
        }

        echo json_encode($response);

    }

    /* This method will return the edit for like create */
    function getCarModel($id) {
        $this->load->model('Car_model');
        $row = $this->Car_model->getRow($id);
        $data['row'] = $row;
        $html = $this->load->view('car_model/edit.php',$data,true);
        $response['html'] = $html;
        echo json_encode($response);  
    }

    function updateModel() {
        $this->load->model('Car_model');
        $id = $this->input->post('id');
        $row = $this->Car_model->getRow($id);

        if (empty($row)) {
            $response['msg'] = "Either record deleted or not found in DB";
            $response['status'] = 100;
            json_encode($response);
            exit;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('color','Color','required');
        $this->form_validation->set_rules('price','Price','required');

        if($this->form_validation->run() == true) {
            //upated record
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['color'] = $this->input->post('color');
            $formArray['transmission'] = $this->input->post('transmission');
            $formArray['price'] = $this->input->post('price');
            $formArray['updated_at'] = date('Y-m-d H:i:s');           
            $id = $this->Car_model->update($id,$formArray);
            $row = $this->Car_model->getRow($id);
            
            $response['row'] = $row;
            $response['status'] = 1;
            $response['message'] ="<div class=\"alert alert-success\">Record has been updated successfully.</div>";
        } else {
            $response['status'] = 0;
            $response['name'] = strip_tags(form_error('name'));
            $response['color'] = strip_tags(form_error('color'));
            $response['price'] = strip_tags(form_error('price'));
            // return error messages
        }

        echo json_encode($response);
    }

    function deleteModel($id) {
        $this->load->model('Car_model');
        $row = $this->Car_model->getRow($id);

        if (empty($row)) {
            $response['msg'] = "<div class=\"alert alert-warning\">Either record already deleted or not found in DB</div>";
            $response['status'] = 0;
            echo json_encode($response);
            exit;
        } else {
            $this->Car_model->delete($id); 
            $response['msg'] = "<div class=\"alert alert-success\">Record has been deleted successfully.</div>";
            $response['status'] = 1;
            echo json_encode($response);
        }
    }
}


?>