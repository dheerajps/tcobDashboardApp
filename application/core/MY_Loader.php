<?php
/*
 * Extends the CI_Loader. Is used to load our template format. When a single page is called, e.g.,
 * $this->load->template('pages/login'), this controller will render that template sandwiched
 * between the header and footer templates. Reduces the amount of code from 3 lines to 1
 */
class MY_Loader extends CI_Loader {
    public function template($template_name, $vars = array(), $return = FALSE)
    {
        if($return):
            $content  = $this->view('templates/header', $vars, $return);
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('templates/footer', $vars, $return);
            return $content;
        else:
            $this->view('templates/header', $vars);
            $this->view($template_name, $vars);
            $this->view('templates/footer', $vars);
        endif;
    }
}
?>