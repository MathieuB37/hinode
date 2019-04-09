<?php

class FormGenerator 
{
    public function generateForm(string $action):void
    {
        $this->form .="<form method='POST' action='$action.php'>";
        $this->form .="<input type='text' name='login' placeholder='login'>";
        $this->form .="<input type='password' name='password' placeholder='password'>";
        $this->form .="<input type='submit'>";
        $this->form .="</form>";
    }


}