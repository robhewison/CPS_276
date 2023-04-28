<?php

class Validation{
    private $error = false;

    public function checkFormat($value, $regex)
    {
        switch($regex){
            case "name": return $this->name($value); break;
            case "address": return $this->address($value); break;
            case "city": return $this->city($value); break;
            case "phone": return $this->phone($value); break;
            case "email": return $this->email($value); break;
            case "dob": return $this->dob($value); break;
            case "password": return $this->password($value); break;
            case "state": return $this->state($value); break;
            default: return 'regex error';
        }
    }

    private function name($value){
        return preg_match('/^[\p{L}\s\'\-]+$/u', $value) ? '' : 'name error';
    }

    private function address($value){
        return preg_match('/^\d+\s[\p{L}\s]+$/u', $value) ? '' : ' address error';
    }

    private function city($value){
        return preg_match('/^[\p{L}\s]+$/u', $value) ? '' : 'city error';
    }

    private function phone($value){
        return preg_match('/^\d{3}\.\d{3}\.\d{4}$/', $value) ? '' : 'phone error';
    }

    private function email($value){
        return filter_var($value, FILTER_VALIDATE_EMAIL) ? '' : 'email error';
    }

    private function dob($value){
        return preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $value) ? '' : 'dob error';
    }

    private function password($value){
        return !empty($value) ? '' : 'password error';
    }

    private function state($value){
        return preg_match('/^[A-Z]{2}$/', $value) ? '' : 'state error';
    }
}

?>
