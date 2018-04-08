<?php

namespace App\Http\Controllers\WebService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
   /**
     *
     * HEADER $token
     *
     * @Rest\Get("/landing")
     * @Rest\View
     * @return array
     *
     */
    public function getCars(Request $request){
        return array("success" => true, "msg" => "api de landings");
        /*
        $curl = curl_init();
        
        $datos = array(
            "type"=>"name",
            "data"=>""
        );
         
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://devmx.com.mx/fmbapp/public/api/landing/valid-input",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($datos),
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
        */
    }

    /**
     *
     * @REST\Post("/landing/valid-input")
     * @return View
     */
    public function landingValidNameAction(Request $request) {

        $data = json_decode($request->getContent(), true);
        $basura = $this->palabrasBasura($data['data']);

        switch ($data['type']) {
            case 'name':
                if(!isset($data['data']) || $data['data'] == ""){
                    return array('success' => false,'input' => 'name', 'msg' => 'Por favor ingresa un nombre');
                }else{
                    if($this->letrasRepetidas($data['data'])){
                        return array('success' => false,'input' => 'name', 'msg' => 'Nombre inválido.');  
                    }
                    if($this->countLetter($data['data'])){
                        return array('success' => false,'input' => 'name', 'msg' => 'Nombre Invalido.');  
                    }

                    if(!$this->testName($data['data'])){
                        return array('success' => false,'input' => 'name', 'msg' => 'Nombre inválido');
                    }
                }
                break;
            case 'patern':
                if(!isset($data['data']) || $data['data'] == ""){
                    return array('success' => false,'input' => 'patern', 'msg' => 'Por favor ingresa un apellido paterno');
                }else{
                    if($this->letrasRepetidas($data['data'])){
                        return array('success' => false,'input' => 'patern', 'msg' => 'Apellido Paterno inválido');  
                    }
                    if($this->countLetter($data['data'])){
                        return array('success' => false,'input' => 'patern', 'msg' => 'Apellido Paterno inválido');  
                    }

                    if(!$this->testName($data['data'])){
                        return array('success' => false, 'input' => 'patern','msg' => 'Apellido Paterno inválido');
                    }
                }
                break;
            case 'matern':
                if(!isset($data['data']) || $data['data'] == ""){
                    return array('success' => false, 'input' => 'matern','msg' => 'Por favor ingresa un apellido materno');
                }else{
                    if($this->letrasRepetidas($data['data'])){
                        return array('success' => false,'input' => 'matern', 'msg' => 'Apellido Materno inválido');  
                    }

                    if($this->countLetter($data['data'])){
                        return array('success' => false,'input' => 'matern', 'msg' => 'Apellido Materno inválido');  
                    }

                    if(!$this->testName($data['data'])){
                        return array('success' => false, 'input' => 'matern','msg' => 'Apellido Materno inválido');
                    }
                }
                break;
            case 'mail':
                if(!isset($data['data']) || $data['data'] == "" || strlen($data['data']) < 1){
                    return array('success' => false, 'msg' => 'Por favor ingresa un correo válido');
                }else{
                    $isFace = substr_count($data['data'], 'facebook');
                    $exp = explode("@",$data['data']);
                    if(isset($exp[1])){
                        $domain = explode(".",$exp[1]);
                        $basura = $this->emailBasura($exp[0]);
                        $basuraa = $this->emailBasura($domain[0]);
                        if (!filter_var($data['data'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                            return array('success' => false, 'msg' => 'Correo Inválido');
                        }
                    }else{
                        return array('success' => false, 'msg' => 'Correo Inválido');
                    }
                    
                }
                break;
            case 'cel':
                if(!isset($data['data']) || $data['data'] == "" || strlen($data['data']) < 1){
                    return array('success' => false, 'msg' => 'Ingresa número de Celular');
                }else{
                    if(strlen($data['data']) < 10 || !is_numeric($data['data'])){
                        return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos');
                    }

                    $rest = substr($data['data'], 0, 6);
                    $restt = substr($data['data'], 4, 10);

                    $isconsec = $this->numerosConsecutivos($rest);
                    $isconsecc = $this->numerosConsecutivos($restt);


                    if($isconsec || $isconsecc) {
                        return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos.');
                    }
                }
                break;
            case 'phone':
                if(!isset($data['data']) || $data['data'] == "" || strlen($data['data']) < 1){
                    return array('success' => false, 'msg' => 'Ingresa número de Teléfono');
                }else{
                    if(strlen($data['data']) < 10 || !is_numeric($data['data'])){
                        return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos');
                    }

                    $rest = substr($data['data'], 0, 6);
                    $restt = substr($data['data'], 4, 10);

                    $isconsec = $this->numerosConsecutivos($rest);
                    $isconsecc = $this->numerosConsecutivos($restt);


                    if($isconsec || $isconsecc){
                        return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos.');
                    }
                }
                break;
            case 'tipoTelefono':
                if(!isset($data['data']) || $data['data'] == "" || strlen($data['data']) < 1){
                    return array('success' => false, 'msg' => 'Ingresa Tipo Teléfono');
                }
                break;
            case 'gender':
                if(!isset($data['data']) || $data['data'] == "" || $data['data'] == '0' || strlen($data['data']) < 1){
                    return array('success' => false, 'msg' => 'Elige un Género');
                }
                break;
            case 'birthday':
                if(!isset($data['data']) || $data['data'] == "" || strlen($data['data']) < 1){
                    return array('success' => false, 'msg' => 'Ingresa una Fecha de Nacimiento');
                }
                break;
            case 'age':
                if(!isset($data['data']) || $data['data'] == "" || strlen($data['data']) < 1){
                    return array('success' => false, 'msg' => 'Ingresa una Edad');
                }
                break;
            case 'interestCampus':
                if(!isset($data['data']) || $data['data'] == "" || $data['data'] == '0' || strlen($data['data']) < 1){
                    return array('success' => false, 'msg' => 'Elige un Campus');
                }
                break;
            case 'interestNivel':
                if(!isset($data['data']) || $data['data'] == "" || $data['data'] == '0' || strlen($data['data']) < 1){
                    return array('success' => false, 'msg' => 'Elige una Área de Interés');
                }
                break;
            case 'nameRegis':
                if(!isset($data['data']) || $data['data'] == ""){
                    return array('success' => false,'input' => 'nameRegis', 'msg' => 'Por favor ingresa un nombre');
                }else{
                    if($this->letrasRepetidas($data['data'])){
                        return array('success' => false,'input' => 'nameRegis', 'msg' => 'Nombre inválido.');  
                    }
                    if($this->countLetter($data['data'])){
                        return array('success' => false,'input' => 'nameRegis', 'msg' => 'Nombre Invalido.');  
                    }

                    if(!$this->testName($data['data'])){
                        return array('success' => false,'input' => 'nameRegis', 'msg' => 'Nombre inválido');
                    }
                }
                break;
            case 'paternRegis':
                if(!isset($data['data']) || $data['data'] == ""){
                    return array('success' => false,'input' => 'paternRegis', 'msg' => 'Por favor ingresa un apellido paterno');
                }else{
                    if($this->letrasRepetidas($data['data'])){
                        return array('success' => false,'input' => 'paternRegis', 'msg' => 'Apellido Paterno inválido');  
                    }
                    if($this->countLetter($data['data'])){
                        return array('success' => false,'input' => 'paternRegis', 'msg' => 'Apellido Paterno inválido');  
                    }

                    if(!$this->testName($data['data'])){
                        return array('success' => false, 'input' => 'paternRegis','msg' => 'Apellido Paterno inválido');
                    }
                }
                break;
            case 'maternRegis':
                if(!isset($data['data']) || $data['data'] == ""){
                    return array('success' => false, 'input' => 'maternRegis','msg' => 'Por favor ingresa un apellido materno');
                }else{
                    if($this->letrasRepetidas($data['data'])){
                        return array('success' => false,'input' => 'maternRegis', 'msg' => 'Apellido Materno inválido');  
                    }

                    if($this->countLetter($data['data'])){
                        return array('success' => false,'input' => 'maternRegis', 'msg' => 'Apellido Materno inválido');  
                    }

                    if(!$this->testName($data['data'])){
                        return array('success' => false, 'input' => 'maternRegis','msg' => 'Apellido Materno inválido');
                    }
                }
                break;
            case 'mailRegis':
                if(!isset($data['data']) || $data['data'] == "" || strlen($data['data']) < 1){
                    return array('success' => false, 'msg' => 'Por favor ingresa un correo válido', 'input' =>'mailRegis');
                }else{
                    $isFace = substr_count($data['data'], 'facebook');
                    $exp = explode("@",$data['data']);
                   if(isset($exp[1])){
                        $domain = explode(".",$exp[1]);
                        $basura = $this->emailBasura($exp[0]);
                        $basuraa = $this->emailBasura($domain[0]);

                        if (!filter_var($data['data'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                            return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mailRegis');
                        }
                    }else{
                            return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mailRegis');
                    }
                    
                }
                break;
        }


        return array('success' => true, 'basura' => $basura);
    }


    /**
     *
     * @REST\Post("/landing/login")
     * @return View
     */
    public function landingLoginAction(Request $request) {

        $data = json_decode($request->getContent(), true);

        $basura = $this->palabrasBasura($data['username']);

        if(!isset($data['username']) || $data['username'] == "" || strlen($data['username']) < 1){
            return array('success' => false, 'msg' => 'Favor de ingresar el usuario', 'input' => 'username');
        }
         
        if(!isset($data['password']) || $data['password'] == "" || strlen($data['password']) < 1){
            return array('success' => false, 'msg' => 'Favor de ingresar la contraseña', 'input' => 'password');
        }


        return array('success' => true, 'user' => $data['username'], 'password' => $data['password'], 'basura' => $basura);
    }


    /**
     *
     * @REST\Post("/landing/register")
     * @return View
     */
    public function landingRegisterAction(Request $request) {

        $data = json_decode($request->getContent(), true);
        
        if(!isset($data['canal']) || $data['canal'] == "" || $data['canal'] == '0' || strlen($data['canal']) < 1){
            return array('success' => false, 'msg' => 'Elige un Canal', 'input' => 'canal', 'request'=>$data['canal']);
        }

        if(!isset($data['csq']) || $data['csq'] == "" || $data['csq'] == '0' || strlen($data['csq']) < 1){
            return array('success' => false, 'msg' => 'Elige un CSQ', 'input' => 'csq', 'request'=>$data['csq']);
        }

        if(!isset($data['interes']) || $data['interes'] == "" || $data['interes'] == '0' || strlen($data['interes']) < 1){
            return array('success' => false, 'msg' => 'Elige un ínteres', 'input' => 'interes');
        }

        if(!isset($data['name']) || $data['name'] == ""){
            return array('success' => false, 'msg' => 'Por favor ingresa un nombre', 'input' => 'name');
        }else{
             if($this->letrasRepetidas($data['name'])){
                        return array('success' => false, 'msg' => 'Nombre inválido.');  
                    }
                    if($this->countLetter($data['name'])){
                        return array('success' => false,'input' => 'name', 'msg' => 'Nombre Invalido.');  
                    }
            if(!$this->testName($data['name'])){
                return array('success' => false, 'msg' => 'Nombre inválido', 'input' => 'name');
            }
        }

        if(!isset($data['patern']) || $data['patern'] == "" || strlen($data['patern']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un apellido paterno', 'input' => 'patern');
        }else{
             if($this->letrasRepetidas($data['patern'])){
                        return array('success' => false, 'msg' => 'Apellido Paterno inválido');  
                    }
            if($this->countLetter($data['patern'])){
                        return array('success' => false,'input' => 'name', 'msg' => 'Apellido Paterno inválido');  
                    }

            if(!$this->testName($data['patern'])){
                return array('success' => false, 'msg' => 'Apellido Paterno inválido', 'input' => 'patern');
            }
        }

        if(!isset($data['matern']) || $data['matern'] == "" || strlen($data['matern']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un apellido materno', 'input' => 'matern');
        }else{
             if($this->letrasRepetidas($data['matern'])){
                        return array('success' => false, 'msg' => 'Apellido Materno inválido');  
                    }
                    if($this->countLetter($data['matern'])){
                        return array('success' => false,'input' => 'name', 'msg' => 'Apellido Materno inválido');  
                    }
            if(!$this->testName($data['matern'])){
                return array('success' => false, 'msg' => 'Apellido Materno inválido', 'input' => 'matern');
            }
        }

        

        if(!isset($data['mail']) || $data['mail'] == "" || strlen($data['mail']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un correo válido', 'input' => 'mail');
        }else{
            $isFace = substr_count($data['mail'], 'facebook');
            $exp = explode("@",$data['mail']);
            if(isset($exp)){
                $domain = explode(".",$exp[1]);
                $basura = $this->emailBasura($exp[0]);
                $basuraa = $this->emailBasura($domain[0]);

                if (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
                }
            }else{
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
            }
        }

        if(!isset($data['ref_mail']) || $data['ref_mail'] == "" || strlen($data['ref_mail']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un correo válido', 'input' => 'ref_mail');
        }else{
            $isFace = substr_count($data['ref_mail'], 'facebook');
            $exp = explode("@",$data['ref_mail']);
            $domain = explode(".",$exp[1]);
            $basura = $this->emailBasura($exp[0]);
            $basuraa = $this->emailBasura($domain[0]);

            if (!filter_var($data['ref_mail'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'ref_mail');
            }
        }

        

        if(!isset($data['cel']) || $data['cel'] == "" || strlen($data['cel']) < 1){
            return array('success' => false, 'msg' => 'Ingresa número de Celular', 'input' => 'cel');
        }else{
            if(strlen($data['cel']) < 10 || !is_numeric($data['cel'])){
                return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos', 'input' => 'cel');
            }

            $rest = substr($data['cel'], 0, 6);
            $restt = substr($data['cel'], 4, 10);

            $isconsec = $this->numerosConsecutivos($rest);
            $isconsecc = $this->numerosConsecutivos($restt);


            if($isconsec || $isconsecc){
                return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos.', 'input' => 'cel');
            }
        }

        if(!isset($data['phone']) || $data['phone'] == "" || strlen($data['phone']) < 1){
            return array('success' => false, 'msg' => 'Ingresa número de Teléfono', 'input' => 'phone');
        }else{
            if(strlen($data['phone']) < 10 || !is_numeric($data['phone'])){
                return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos', 'input' => 'phone');
            }

            $rest = substr($data['phone'], 0, 6);
            $restt = substr($data['phone'], 4, 10);

            $isconsec = $this->numerosConsecutivos($rest);
            $isconsecc = $this->numerosConsecutivos($restt);


            if($isconsec || $isconsecc){
                return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos.', 'input' => 'phone');
            }
        }

        if(!isset($data['gender']) || $data['gender'] == "" || $data['gender'] == '0' || strlen($data['gender']) < 1){
            return array('success' => false, 'msg' => 'Elige un Género', 'input' => 'gender');
        }

        if(!isset($data['birthday']) || $data['birthday'] == "" || strlen($data['birthday']) < 1){
            return array('success' => false, 'msg' => 'Ingresa una Fecha de Nacimiento', 'input' => 'birthday');
        }

        if(!isset($data['age']) || $data['age'] == "" || strlen($data['age']) < 1){
            return array('success' => false, 'msg' => 'Ingresa una Edad', 'input' => 'age');
        }

        if(!isset($data['interestCampus']) || $data['interestCampus'] == "" || $data['interestCampus'] == '0' || strlen($data['interestCampus']) < 1){
            return array('success' => false, 'msg' => 'Elige un Campus', 'input' => 'interestCampus');
        }

        if(!isset($data['interestNivel']) || $data['interestNivel'] == "" || $data['interestNivel'] == '0' || strlen($data['interestNivel']) < 1){
            return array('success' => false, 'msg' => 'Elige una Nivel', 'input' => 'interestNivel');
        }

        if(!isset($data['citaCampus']) || $data['citaCampus'] == "" || $data['citaCampus'] == '0' || strlen($data['citaCampus']) < 1){
            return array('success' => false, 'msg' => 'Elige un Campus', 'input' => 'citaCampus');
        }

        if(!isset($data['tipificacion']) || $data['tipificacion'] == "" || $data['tipificacion'] == '0' || strlen($data['tipificacion']) < 1){
            return array('success' => false, 'msg' => 'Elige una Tipificación', 'input' => 'tipificacion');
        }

        //age,canal,cel,celRegis,citaAsesor,citaCall,citaCampus,citaTransfer,citadate,csq,gender,interes,interestArea,interestCampus,interestCareer,interestCycle,interestModel,interestNivel,mail,mailRegis,matern,maternRegis,name,nameRegis,note,patern,paternRegis,phone,phoneRegis,prent,sinmail,tipificacion,user
        if(!isset($data['mailRegis']) || $data['mailRegis'] == "" || strlen($data['mailRegis']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un correo válido', 'input' => 'mailRegis');
        }else{
            $isFace = substr_count($data['mailRegis'], 'facebook');
            $exp = explode("@",$data['mailRegis']);
            if(isset($exp)){
                $domain = explode(".",$exp[1]);
                $basura = $this->emailBasura($exp[0]);
                $basuraa = $this->emailBasura($domain[0]);

                if (!filter_var($data['mailRegis'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
                }
            }else{
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
            }
        }

        return array('success' => true, 'msg' => '');
    }


    /**
     *
     * @REST\Post("/landing/register-solo")
     * @return View
     */
    public function landingRegisterSoloAction(Request $request) {

        $data = json_decode($request->getContent(), true);

        if(!isset($data['name']) || $data['name'] == ""){
            return array('success' => false, 'msg' => 'Por favor ingresa un nombre', 'input' => 'name');
        }else{
            if($this->letrasRepetidas($data['name'])){
                return array('success' => false, 'msg' => 'Nombre inválido.');  
            }
            if($this->countLetter($data['name'])){
                return array('success' => false,'input' => 'name', 'msg' => 'Nombre Invalido.');  
            }
            if(!$this->testName($data['name'])){
                return array('success' => false, 'msg' => 'Nombre inválido', 'input' => 'name');
            }
        }

        if(!isset($data['patern']) || $data['patern'] == "" || strlen($data['patern']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un apellido paterno', 'input' => 'patern');
        }else{
            if($this->letrasRepetidas($data['patern'])){
                return array('success' => false, 'msg' => 'Apellido Paterno inválido');  
            }
            if($this->countLetter($data['patern'])){
                return array('success' => false,'input' => 'name', 'msg' => 'Apellido Paterno inválido');  
            }
            if(!$this->testName($data['patern'])){
                return array('success' => false, 'msg' => 'Apellido Paterno inválido', 'input' => 'patern');
            }
        }

        if(!isset($data['matern']) || $data['matern'] == "" || strlen($data['matern']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un apellido materno', 'input' => 'matern');
        }else{
            if($this->letrasRepetidas($data['matern'])){
                return array('success' => false, 'msg' => 'Apellido Materno inválido');  
            }
            if($this->countLetter($data['matern'])){
                return array('success' => false,'input' => 'name', 'msg' => 'Apellido Materno inválido');  
            }
            if(!$this->testName($data['matern'])){
                return array('success' => false, 'msg' => 'Apellido Materno inválido', 'input' => 'matern');
            }

        }

        if(!isset($data['mail']) || $data['mail'] == "" || strlen($data['mail']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un correo válido', 'input' => 'mail');
        }else{
            $isFace = substr_count($data['mail'], 'facebook');
            $exp = explode("@",$data['mail']);
            if(isset($exp)){
                $domain = explode(".",$exp[1]);
                $basura = $this->emailBasura($exp[0]);
                $basuraa = $this->emailBasura($domain[0]);

                if (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
                }
            }else{
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
            }
        }

        if(!isset($data['cel']) || $data['cel'] == "" || strlen($data['cel']) < 1){
            return array('success' => false, 'msg' => 'Ingresa número de Celular', 'input' => 'cel');
        }else{
            if(strlen($data['cel']) < 10 || !is_numeric($data['cel'])){
                return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos', 'input' => 'cel');
            }

            $rest = substr($data['cel'], 0, 6);
            $restt = substr($data['cel'], 4, 10);

            $isconsec = $this->numerosConsecutivos($rest);
            $isconsecc = $this->numerosConsecutivos($restt);


            if($isconsec || $isconsecc){
                return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos.', 'input' => 'cel');
            }
        }

        if(!isset($data['phone']) || $data['phone'] == "" || strlen($data['phone']) < 1){
            return array('success' => false, 'msg' => 'Ingresa número de Teléfono2', 'input' => 'phone');
        }else{
            if(strlen($data['phone']) < 10 || !is_numeric($data['phone'])){
                return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos', 'input' => 'phone');
            }

            $rest = substr($data['phone'], 0, 6);
            $restt = substr($data['phone'], 4, 10);

            $isconsec = $this->numerosConsecutivos($rest);
            $isconsecc = $this->numerosConsecutivos($restt);


            if($isconsec || $isconsecc){
                return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos.', 'input' => 'phone');
            }
        }

        if(!isset($data['gender']) || $data['gender'] == "" || $data['gender'] == '0' || strlen($data['gender']) < 1){
            return array('success' => false, 'msg' => 'Elige un Género', 'input' => 'gender');
        }

        if(!isset($data['birthday']) || $data['birthday'] == "" || strlen($data['birthday']) < 1){
            return array('success' => false, 'msg' => 'Ingresa una Fecha de Nacimiento', 'input' => 'birthday');
        }

        if(!isset($data['age']) || $data['age'] == "" || strlen($data['age']) < 1){
            return array('success' => false, 'msg' => 'Ingresa una Edad', 'input' => 'age');
        }

        if(!isset($data['interestCampus']) || $data['interestCampus'] == "" || $data['interestCampus'] == '0' || strlen($data['interestCampus']) < 1){
            return array('success' => false, 'msg' => 'Elige un Campus', 'input' => 'interestCampus');
        }

        if(!isset($data['interestNivel']) || $data['interestNivel'] == "" || $data['interestNivel'] == '0' || strlen($data['interestNivel']) < 1){
            return array('success' => false, 'msg' => 'Elige una Área de Interés', 'input' => 'interestNivel');
        }


        if(!isset($data['mailRegis']) || $data['mailRegis'] == "" || strlen($data['mailRegis']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un correo válido', 'input' => 'mailRegis');
        }else{
            $isFace = substr_count($data['mailRegis'], 'facebook');
            $exp = explode("@",$data['mailRegis']);
            if(isset($exp)){
                $domain = explode(".",$exp[1]);
                $basura = $this->emailBasura($exp[0]);
                $basuraa = $this->emailBasura($domain[0]);

                if (!filter_var($data['mailRegis'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
                }
            }else{
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
            }
        }


        return array('success' => true, 'msg' => '');
    }

    /**
     *
     * @REST\Post("/landing/register-promotion")
     * @return View
     */
    public function landingRegisterPromotionAction(Request $request) {

        $data = json_decode($request->getContent(), true);

        if(!isset($data['subActivity']) || $data['subActivity'] == "" || $data['subActivity'] == '0' || strlen($data['subActivity']) < 1){
            return array('success' => false, 'msg' => 'Elige un Sub tipo de Actividad', 'input' => 'subActivity');
        }

        if(!isset($data['company']) || $data['company'] == "" || $data['company'] == '0' || strlen($data['company']) < 1){
            return array('success' => false, 'msg' => 'Elige una Escuela/Empresa', 'input' => 'company');
        }

         if(!isset($data['subsubActivity']) || $data['subsubActivity'] == "" || $data['subsubActivity'] == '0' || strlen($data['subsubActivity']) < 1){
            return array('success' => false, 'msg' => 'Elige un Sub Sub tipo de Actividad', 'input' => 'subsubActivity');
        }

        if(!isset($data['tourn']) || $data['tourn'] == "" || $data['tourn'] == '0' || strlen($data['tourn']) < 1){
            return array('success' => false, 'msg' => 'Elige un Turno', 'input' => 'tourn');
        }

        if(!isset($data['school']) || $data['school'] == "" || $data['school'] == '0' || strlen($data['school']) < 1){
            return array('success' => false, 'msg' => 'Elige una Escuela/Empresa', 'input' => 'school');
        }

        if(!isset($data['name']) || $data['name'] == ""){
            return array('success' => false, 'msg' => 'Por favor ingresa un nombre', 'input' => 'name');
        }else{
            if($this->letrasRepetidas($data['name'])){
                        return array('success' => false, 'msg' => 'Nombre inválido.');  
                    }
            if(!$this->testName($data['name'])){
                return array('success' => false, 'msg' => 'Nombre inválido', 'input' => 'name');
            }
        }

        if(!isset($data['patern']) || $data['patern'] == "" || strlen($data['patern']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un apellido paterno', 'input' => 'patern');
        }else{
            if($this->letrasRepetidas($data['patern'])){
                        return array('success' => false, 'msg' => 'Apellido Paterno inválido');  
                    }
            if(!$this->testName($data['patern'])){
                return array('success' => false, 'msg' => 'Apellido Paterno inválido', 'input' => 'patern');
            }
        }

        if(!isset($data['matern']) || $data['matern'] == "" || strlen($data['matern']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un apellido materno', 'input' => 'matern');
        }else{
            if($this->letrasRepetidas($data['matern'])){
                        return array('success' => false, 'msg' => 'Apellido Materno inválido');  
                    }
            if(!$this->testName($data['matern'])){
                return array('success' => false, 'msg' => 'Apellido Materno inválido', 'input' => 'matern');
            }
        }

        if(!isset($data['mail']) || $data['mail'] == "" || strlen($data['mail']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un correo válido', 'input' => 'mail');
        }else{
            $isFace = substr_count($data['mail'], 'facebook');
            $exp = explode("@",$data['mail']);
            if(isset($exp[1])){
                $domain = explode(".",$exp[1]);
                $basura = $this->emailBasura($exp[0]);
                $basuraa = $this->emailBasura($domain[0]);

                if (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
                }
            }else{
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
            }
        }

        if(!isset($data['cel']) || $data['cel'] == "" || strlen($data['cel']) < 1){
            return array('success' => false, 'msg' => 'Ingresa número de Celular', 'input' => 'cel');
        }else{
            if(strlen($data['cel']) < 10 || !is_numeric($data['cel'])){
                return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos', 'input' => 'cel');
            }

            $rest = substr($data['cel'], 0, 6);
            $restt = substr($data['cel'], 4, 10);

            $isconsec = $this->numerosConsecutivos($rest);
            $isconsecc = $this->numerosConsecutivos($restt);


            if($isconsec || $isconsecc){
                return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos.', 'input' => 'cel');
            }
        }

        if(!isset($data['phone']) || $data['phone'] == "" || strlen($data['phone']) < 1){
            return array('success' => false, 'msg' => 'Ingresa número de Teléfono', 'input' => 'phone');
        }else{
            if(strlen($data['phone']) < 10 || !is_numeric($data['phone'])){
                return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos', 'input' => 'phone');
            }

            $rest = substr($data['phone'], 0, 6);
            $restt = substr($data['phone'], 4, 10);

            $isconsec = $this->numerosConsecutivos($rest);
            $isconsecc = $this->numerosConsecutivos($restt);


            if($isconsec || $isconsecc){
                return array('success' => false, 'msg' => 'Al menos debe contener 10 dígitos.', 'input' => 'phone');
            }
        }

        if(!isset($data['gender']) || $data['gender'] == "" || $data['gender'] == '0' || strlen($data['gender']) < 1){
            return array('success' => false, 'msg' => 'Elige un Género', 'input' => 'gender');
        }

        if(!isset($data['birthday']) || $data['birthday'] == "" || strlen($data['birthday']) < 1){
            return array('success' => false, 'msg' => 'Ingresa una Fecha de Nacimiento', 'input' => 'birthday');
        }

        if(!isset($data['age']) || $data['age'] == "" || strlen($data['age']) < 1){
            return array('success' => false, 'msg' => 'Ingresa una Edad', 'input' => 'age');
        }

        if(!isset($data['interestCampus']) || $data['interestCampus'] == "" || $data['interestCampus'] == '0' || strlen($data['interestCampus']) < 1){
            return array('success' => false, 'msg' => 'Elige un Campus', 'input' => 'interestCampus');
        }

        if(!isset($data['interestNivel']) || $data['interestNivel'] == "" || $data['interestNivel'] == '0' || strlen($data['interestNivel']) < 1){
            return array('success' => false, 'msg' => 'Elige una Área de Interés', 'input' => 'interestNivel');
        }


        return array('success' => true, 'msg' => '');
    }


    /**
     *
     * @REST\Post("/landing/referido-referente")
     * @return View
     */
    public function landingReferidoReferenteAction(Request $request) {

        $data = json_decode($request->getContent(), true);

        if(!isset($data['name']) || $data['name'] == ""){
            return array('success' => false, 'msg' => 'Por favor ingresa un nombre', 'input' => 'name');
        }else{
            if($this->letrasRepetidas($data['name'])){return array('success' => false, 'msg' => 'Nombre inválido.'); }
            if(!$this->testName($data['name'])){
                return array('success' => false, 'msg' => 'Nombre inválido', 'input' => 'name');
            }
        }

        if(!isset($data['patern']) || $data['patern'] == "" || strlen($data['patern']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un apellido paterno', 'input' => 'patern');
        }else{
            if($this->letrasRepetidas($data['patern'])){return array('success' => false, 'msg' => 'Apellido Paterno inválido'); }

            if(!$this->testName($data['patern'])){
                return array('success' => false, 'msg' => 'Apellido Paterno inválido', 'input' => 'patern');
            }
        }

        if(!isset($data['matern']) || $data['matern'] == "" || strlen($data['matern']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un apellido materno', 'input' => 'matern');
        }else{
            if($this->letrasRepetidas($data['matern'])){return array('success' => false, 'msg' => 'Nombre inválido.'); }

            if(!$this->testName($data['matern'])){
                return array('success' => false, 'msg' => 'Apellido Materno inválido', 'input' => 'matern');
            }
        }

        if(!isset($data['mail']) || $data['mail'] == "" || strlen($data['mail']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un correo válido', 'input' => 'mail');
        }else{
            $isFace = substr_count($data['mail'], 'facebook');
            $exp = explode("@",$data['mail']);
            if(isset($exp)){
                $domain = explode(".",$exp[1]);
                $basura = $this->emailBasura($exp[0]);
                $basuraa = $this->emailBasura($domain[0]);

                if (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
                }
            }else{
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
            }
        }

        
        if(!isset($data['tipo']) || $data['tipo'] == "" || strlen($data['tipo']) < 1){
            return array('success' => false, 'msg' => 'Ingresa tipo de Telefono', 'input' => 'tipo');
        }


        if(!isset($data['interestCampus']) || $data['interestCampus'] == "" || $data['interestCampus'] == '0' || strlen($data['interestCampus']) < 1){
            return array('success' => false, 'msg' => 'Elige un Campus', 'input' => 'interestCampus');
        }

        if(!isset($data['interestNivel']) || $data['interestNivel'] == "" || $data['interestNivel'] == '0' || strlen($data['interestNivel']) < 1){
            return array('success' => false, 'msg' => 'Elige una Modalidad', 'input' => 'interestNivel');
        }

        if(!isset($data['interestModel']) || $data['interestModel'] == "" || $data['interestModel'] == '0' || strlen($data['interestModel']) < 1){
            return array('success' => false, 'msg' => 'Elige una Área de Interés', 'input' => 'interestModel');
        }

        if(!isset($data['interestCareer']) || $data['interestCareer'] == "" || $data['interestCareer'] == '0' || strlen($data['interestCareer']) < 1){
            return array('success' => false, 'msg' => 'Elige una Carrera', 'input' => 'interestCareer');
        }


        return array('success' => true, 'msg' => '');
    }

    /**
     *
     * @REST\Post("/landing/referido-referente")
     * @return View
     */
    public function landingReferidoReferenteWebAction(Request $request) {

        $data = json_decode($request->getContent(), true);    

        if(!isset($data['mailRegis']) || $data['mailRegis'] == "" || strlen($data['mailRegis']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un correo válido', 'input' => 'mailRegis');
        }else{
            $isFace = substr_count($data['mailRegis'], 'facebook');
            $exp = explode("@",$data['mailRegis']);
            $domain = explode(".",$exp[1]);
            $basura = $this->emailBasura($exp[0]);
            $basuraa = $this->emailBasura($domain[0]);

            if (!filter_var($data['mailRegis'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mailRegis');
            }
        }

        if(!isset($data['name']) || $data['name'] == ""){
            return array('success' => false, 'msg' => 'Por favor ingresa un nombre', 'input' => 'name');
        }else{
            if($this->letrasRepetidas($data['name'])){return array('success' => false, 'msg' => 'Nombre inválido.'); }
            if(!$this->testName($data['name'])){
                return array('success' => false, 'msg' => 'Nombre inválido', 'input' => 'name');
            }
        }

        if(!isset($data['patern']) || $data['patern'] == "" || strlen($data['patern']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un apellido paterno', 'input' => 'patern');
        }else{
            if($this->letrasRepetidas($data['patern'])){return array('success' => false, 'msg' => 'Apellido Paterno inválido'); }

            if(!$this->testName($data['patern'])){
                return array('success' => false, 'msg' => 'Apellido Paterno inválido', 'input' => 'patern');
            }
        }

        if(!isset($data['matern']) || $data['matern'] == "" || strlen($data['matern']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un apellido materno', 'input' => 'matern');
        }else{
            if($this->letrasRepetidas($data['matern'])){return array('success' => false, 'msg' => 'Apellido Materno inválido'); }

            if(!$this->testName($data['matern'])){
                return array('success' => false, 'msg' => 'Apellido Materno inválido', 'input' => 'matern');
            }
        }

        if(!isset($data['mail']) || $data['mail'] == "" || strlen($data['mail']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un correo válido', 'input' => 'mail');
        }else{
            $isFace = substr_count($data['mail'], 'facebook');
            $exp = explode("@",$data['mail']);
            if(isset($exp)){
                $domain = explode(".",$exp[1]);
                $basura = $this->emailBasura($exp[0]);
                $basuraa = $this->emailBasura($domain[0]);

                if (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
                }
            }else{
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
            }
        }

        
        

        

        if(!isset($data['interestCampus']) || $data['interestCampus'] == "" || $data['interestCampus'] == '0' || strlen($data['interestCampus']) < 1){
            return array('success' => false, 'msg' => 'Elige un Campus', 'input' => 'interestCampus');
        }

        if(!isset($data['interestNivel']) || $data['interestNivel'] == "" || $data['interestNivel'] == '0' || strlen($data['interestNivel']) < 1){
            return array('success' => false, 'msg' => 'Elige una Modalidad', 'input' => 'interestNivel');
        }

        if(!isset($data['interestModel']) || $data['interestModel'] == "" || $data['interestModel'] == '0' || strlen($data['interestModel']) < 1){
            return array('success' => false, 'msg' => 'Elige una Área de Interés', 'input' => 'interestModel');
        }

        if(!isset($data['interestCareer']) || $data['interestCareer'] == "" || $data['interestCareer'] == '0' || strlen($data['interestCareer']) < 1){
            return array('success' => false, 'msg' => 'Elige una Carrera', 'input' => 'interestCareer');
        }


        return array('success' => true, 'msg' => '');
    }


    /**
     *
     * @REST\Post("/landing/search")
     * @return View
     */
    public function landingSearchAction(Request $request) {

        $data = json_decode($request->getContent(), true);
        if(isset($data['mail'])){
         if($data['mail'] != ""  || strlen($data['mail']) < 1){
                return array('success' => false, 'msg' => 'Por favor ingresa un correo válido', 'input' => 'mail');
            }else{
                $isFace = substr_count($data['mail'], 'facebook');
                $exp = explode("@",$data['mail']);
                if(isset($exp[1])){
                    $domain = explode(".",$exp[1]);
                    $basura = $this->emailBasura($exp[0]);
                    $basuraa = $this->emailBasura($domain[0]);

                    if (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                        return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
                    }
                }else{
                        return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
                }
            }   
        }    
        if(isset($data['mailTutor']) ){
            if( $data['mailTutor'] != "" || $data['mailTutor'] == "" || strlen($data['mailTutor']) < 1){
                return array('success' => false, 'msg' => 'Por favor ingresa un correo válido', 'input' => 'mailTutor');
            }else{
                $isFace = substr_count($data['mailTutor'], 'facebook');
                $exp = explode("@",$data['mailTutor']);
                if(isset($exp[1])){
                    $domain = explode(".",$exp[1]);
                    $basura = $this->emailBasura($exp[0]);
                    $basuraa = $this->emailBasura($domain[0]);

                    if (!filter_var($data['mailTutor'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                        return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mailTutor');
                    }
                }else{
                        return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mailTutor');
                }
            }     
        }                 
        return array('success' => true, 'msg' => '');
    }


    /**
     *
     * @REST\Post("/landing/search-inbound")
     * @return View
     */
    public function landingSearchAInboundction(Request $request) {

        $data = json_decode($request->getContent(), true);

        if(!isset($data['mail']) || $data['mail'] == "" || strlen($data['mail']) < 1){
            return array('success' => false, 'msg' => 'Por favor ingresa un correo válido', 'input' => 'mail');
        }else{
            $isFace = substr_count($data['mail'], 'facebook');
            $exp = explode("@",$data['mail']);
            if(isset($exp[1])){
                $domain = explode(".",$exp[1]);
                $basura = $this->emailBasura($exp[0]);
                $basuraa = $this->emailBasura($domain[0]);

                if (!filter_var($data['mail'], FILTER_VALIDATE_EMAIL) || $isFace > '0' || $basura || $basuraa) {
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
                }
            }else{
                    return array('success' => false, 'msg' => 'Correo Inválido', 'input' => 'mail');
            }
        }


        return array('success' => true, 'msg' => '');
    }


    function testName($name){
        $name = str_replace("ñ", "", $name);
        $name = str_replace("Ñ", "", $name);
        $return = true;
        $posa = strpos($name, 'a');
        $pose = strpos($name, 'e');
        $posi = strpos($name, 'i');
        $poso = strpos($name, 'o');
        $posu = strpos($name, 'u');
        $posaa = strpos($name, 'A');
        $posee = strpos($name, 'E');
        $posii = strpos($name, 'I');
        $posoo = strpos($name, 'O');
        $posuu = strpos($name, 'U');

        $spaces = substr_count($name, ' ');
        if (!preg_match("/^[a-zA-Z ]*$/",$name) ||  strlen($name) < 3 || $spaces > 1 || (!$posa && !$pose && !$posi && !$poso && !$posu && !$posaa && !$posee && !$posii && !$posoo && !$posuu)) {
            $return = false;
        }

        if ($this->palabrasBasura($name)) {
            return true;
        }else{
            return false;
        }
        
        return $return;
    }

    function numerosConsecutivos($num){
        $numeros = str_split($num);
        $numItems = count($numeros);
        $i = 0;
        foreach ($numeros as $clave => $valor) {
            if(++$i != $numItems) {
                if($numeros[$clave+1]-$numeros[$clave] != 1) return false;
            }
        }

        return true;
    }

    function palabrasBasura($text){
        $palabrasJson = [
            "alkj",
            "balk",
            "blaj",
            "blal",
            "ccfe",
            "cerc",
            "cfew",
            "crcw",
            "cten",
            "cwef",
            "cwer",
            "dgji",
            "dhdn",
            "djuo",
            "dmjc",
            "efcc",
            "ehew",
            "ercw",
            "erhu",
            "eruh",
            "fccf",
            "fdgj",
            "fdju",
            "ffgf",
            "fgff",
            "fgfg",
            "fghu",
            "fyut",
            "gfdg",
            "gffg",
            "gfgf",
            "ghui",
            "gjif",
            "gyhu",
            "gyuw",
            "hdnv",
            "hewr",
            "huik",
            "huiw",
            "huwe",
            "ifdj",
            "igsd",
            "ikty",
            "iwre",
            "jbla",
            "jcte",
            "jifd",
            "jigs",
            "jksd",
            "juoi",
            "kjbl",
            "kqnw",
            "kqwk",
            "ksdm",
            "ktyf",
            "kuyt",
            "lajk",
            "lbal",
            "lkjb",
            "lsdm",
            "m sk",
            "mdhj",
            "nvji",
            "oidf",
            "rcer",
            "rcwe",
            "rhue",
            "rhui",
            "ruhu",
            "sdhd",
            "sdmd",
            "sdmj",
            "skqn",
            "skqw",
            "swqn",
            "tenv",
            "tfgh",
            "tyfy",
            "uerh",
            "uerw",
            "ugfd",
            "uhuw",
            "uikt",
            "uiwr",
            "uoid",
            "uwer",
            "uytf",
            "vjig",
            "wefc",
            "werc",
            "werh",
            "weru",
            "wqnm",
            "wreh",
            "yfyu",
            "yhue",
            "ytfg",
            "yugf",
            "yutf",
            "yuwe",
            "fgsd",
            "ergs",
            "grty",
            "drgd",
            "alsd",
            "mjct",
            "envj",
            "djks",
            "dmdh",
            "jsdh",
            "dnv",
            "xzzf",
            "afsa",
            "tdg",
            "gsz",
            "sz",
            "duhe",
            "edc",
            "cgh",
            "ghd",
            "turru",
            "rurt",
            "fgj",
            "gjg",
            "gfk",
            "glh",
            "huj",
            "shd",
            "bcc",
            "hshs",
            "djdj",
            "asda",
            "fdfd",
            "dxxc",
            "hhhh",
            "bxcb",
            "blabla",
            "bloblo",
            "aloh",
            "nrnr",
            "fgdg",
            "ffyf",
            "baaf",
            "ddcc",
            "ffdd",
            "sjsn",
            "sfdd",
            "fqef",
            "fsff",
            "ddxc",
            "gdgf",
            "hfcb",
            "gjdj",
            "hxgh",
            "xhgx",
            "bhbh",
            "kjhh",
            "bsbs",
            "klhl",
            "rqrq",
            "kekd",
            "sasa",
            "sisi",
            "reret",
            "xdsg",
            "abec",
            "fefe",
            "webo",
            "nyolx",
            "ccgjh",
            "fadf",
            "bulabe",
            "efq",
            "luego",
            "erdem",
            "juanbenito",
            "yolo",
            "ddsv",
            "memo",
            "fulanito",
            "hfcbbi",
            "hjdjh",
            "rirdfo",
            "hisjd",
            "ezra",
            "vcb",
            "taewe",
            "http",
            "fsdgfsd",
            "pancho",
            "lokon",
            "izhmir",
            "gmbo",
            "tito",
            "erwq",
            "jhk",
            "aaee",
            "oeds",
            "milki",
            "oskr",
            "sunn",
            "rerer",
            "nora vivia",
            "retrdtr",
            "krmn",
            "hrth",
            "afwef",
            "codision",
            "ytufut",
            "rwerwere",
            "akiva",
            "jeziel",
            "bla bla",
            "raraaf",
            "kbd",
            "dage",
            "dgfg",
            "frfregetgr",
            "yuya",
            "fuif",
            "xghij",
            "wegwgr",
            "vhg",
            "gvg",
            "fdghf",
            "luigui",
            "luialmanza",
            "asdasdas",
            "xereerer",
            "puta madre",
            "gdfgd",
            "matafesio",
            "ttgt",
            "bfbf",
            "ahhesaqs",
            "asdda",
            "yolia",
            "sedd",
            "dffgt",
            "tutsi",
            "fefreferfr",
            "assaasa",
            "sfdzser",
            "chucho",
            "ghfg",
            "alfito",
            "ckbad",
            "huhbgvf",
            "adaw",
            "wwdd",
            "asumen",
            "xdsgdg",
            "martona",
            "chanfle",
            "dfgdf",
            "hhjhge",
            "dnjs",
            "hhj",
            "kajs",
            "jsjs",
            "jajaj",
            "aasaa",
            "aafs",
            "only",
            "networ",
            "agah",
            "shsh",
            "jjs",
            "gghh",
            "bbhh",
            "nkoh",
            "klhj",
            "gdgd",
            "xret",
            "xrre",
            "kml",
            "iolk",
            "tengo",
            "pgom",
            "cst",
            "suhh",
            "ghf",
            "pepito",
            "iuni",
            "ujiu",
            "baby",
            "lolo",
            "hardy",
            "control",
            "desconocido",
            "apocope",
            "zvzc",
            "csaf",
            "wars",
            "atsv",
            "qeax",
            "gasf",
            "csaz",
            "klkl",
            "rowe",
            "ejrl",
            "dsc",
            "nivx",
            "djfa",
            "eoir",
            "kdlf",
            "fsdl",
            "kwje",
            "xlcv",
            "rtuy",
            "jcvn",
            "qazx",
            "swed",
            "dcvf",
            "vrtg",
            "byhn",
            "mjui",
            "iklo",
            "fdfg",
            "yuiop",
            "fghj",
            "jklm",
            "zxcv",
            "zxcvb",
            "xcvb",
            "cvbn",
            "vbnm",
            "mnbv",
            "cxza",
            "fdsa",
            "kjhg",
            "lkjh",
            "poiu",
            "iuuyt",
            "rewq",
            "wqwqw",
            "qwqw",
            "zqwd",
            "qwdd",
            "wksn",
            "ksnj",
            "snjs",
            "nsns",
            "snsn",
            "woie",
            "oier",
            "ssgg",
            "hjje",
            "jjee",
            "wwee",
            "eerr",
            "ttyy",
            "yyuu",
            "tyyu",
            "aass",
            "assd",
            "ssdd",
            "soso",
            "dsew",
            "sewq",
            "ewqe",
            "wqew",
            "qewt",
            "eqwt",
            "qwte",
            "wtew",
            "ewew",
            "wewq",
            "ewqw",
            "wqwq",
            "aegs",
            "egsb",
            "gsbg",
            "jkty",
            "ktyt",
            "tyty",
            "ytyj",
            "tyjr",
            "ewer",
            "fdd",
            "kbak",
            "ijus",
            "ppe",
            "edau",
            "dgh",
            "wdc",
            "ksdy",
            "fetg",
            "didd",
            "sdvs",
            "asaf",
            "ghh",
            "xxx",
            "msus",
            "fsd",
            "tuyt",
            "elver",
            "jsks",
            "drozz",
            "lmm",
            "leet",
            "hfc",
            "ccxx",
            "fff",
            "hlek",
            "hjja",
            "pee",
            "ryyy",
            "viro",
            "ajaj",
            "utbb",
            "psm",
            "djah",
            "msm",
            "brgb",
            "kik",
            "vbv",
            "ghg",
            "tdfy",
            "xhkf",
            "aqwew",
            "kll",
            "sdd",
            "test",
            "jgkk",
            "aaad",
            "abb",
            "mylady",
            "fgg",
            "adfw",
            "mmnj",
            "jhgs",
            "ffkc",
            "idj",
            "ernej",
            "abc",
            "adk",
            "cdcd",
            "xasf",
            "jkk",
            "adds",
            "frr",
            "gyuu",
            "ffca",
            "ftgh",
            "ffsf",
            "aasds",
            "afdsjkl",
            "asdrubal",
            "xxasd",
            "asfcasdc",
            "fewrwererwee",
            "hfs",
            "afa",
            "ayoung",
            "fddsadas",
            "xcasd",
            "ewrwer",
            "fjddjv",
            "adfwf",
            "nohh",
            "tzuc",
            "lumbi",
            "xadsa",
            "werwer",
            "dgvxgv",
            "afoaisnfona",
            "noh",
            "zib",
            "vgfyhjrfyje",
            "asdf",
            "maruio",
            "mander",
            "mades",
            "gayluis",
            "gaylor",
            "asdk",
            "ajfi",
            "ojss",
            "cxbcvn",
            "oacr",
            "line",
            "atom",
            "aksis",
            "jolik",
            "veic",
            "knight",
            "caca",
            "orina",
            "mierda",
            "asqueroso",
            "apellido",
            "qwrqwweq",
            "superman",
            "culiada",
            "manches",
            "maricon",
            "pendejo",
            "batman",
            "marica",
            "ramera",
            "skulls",
            "dadsa",
            "dffdd",
            "holis",
            "mamar",
            "nalga",
            "perra",
            "tinaa",
            "kdfh",
            "jslk",
            "dlkf",
            "wieo",
            "completonopasa",
            "cnvm",
            "trial",
            "iuiou",
            "aeiou",
            "adsf",
            "culo",
            "jaja",
            "joto",
            "nomb",
            "pito",
            "puta",
            "puto",
            "xoxo",
            "verga",
            "nene",
            "dada",
            "baboso",
            "pantera",
            "pene",
            "popo",
            "tu puta madre",
            "chinga",
            "zqwdd",
            "web",
            "gwer",
            "dfgh",
            "dfgha",
            "fgh",
            "wweerr",
            "sososo",
            "aegsbg",
            "wksnjs",
            "woier",
            "segibia",
            "dassgg",
            "ttyyuu",
            "qwer",
            "dsewqewt",
            "goerd",
            "nsnsn",
            "ajuer",
            "hjjee",
            "aassdd",
            "eqwtewewqwq",
            "jktytyjr",
            "chula",
            "perdo",
            "lopo",
            "heintricu",
            "rocken",
            "shazam",
            "elver",
            "coca",
            "nombre",
            "rick",
            "kiko",
            "moco",
            "moshe",
            "privado",
            "kimo",
            "contacto",
            "sabe",
            "perro",
            "demos",
            "tutu",
            "sionsa",
            "ninguno",
            "poseidon",
            "asf",
            "cola",
            "pancho",
            "abombado",
            "asds",
            "dhhgdd",
            "oiidl",
            "xhhjh",
            "ooiddl",
            "fhhjse"            
        ];

        $return = array_search($text, $palabrasJson);

        
        if(!$return){
            return true;
        }else{
            return false;
        }
    }

    function emailBasura($text){
        $basura = [
            "anonimo",
            "sdasa",
            "sadasdas4",
            "sdfsd",
            "gay",
            "rari",
            "ajshs",
            "aad",
            "ads",
            "aea",
            "ahh",
            "apellido",
            "asf",
            "asj",
            "bbb",
            "bfj",
            "bjk",
            "bvh",
            "ccc",
            "cds",
            "chc",
            "cju",
            "csd",
            "cvb",
            "cxz",
            "dadsa",
            "ddd",
            "dee",
            "demo",
            "dfg",
            "djf",
            "djj",
            "dnd",
            "drh",
            "dse",
            "dsf",
            "dss",
            "dsx",
            "dvc",
            "dxx",
            "dyy",
            "eee",
            "eeh",
            "ewf",
            "fff",
            "fgg",
            "fgt",
            "fhg",
            "fjg",
            "fjh",
            "fkj",
            "fnh",
            "frg",
            "gfl",
            "ggg",
            "ghb",
            "ghh",
            "ghk",
            "gjs",
            "gvk",
            "hah",
            "hch",
            "hdj",
            "hgd",
            "hgf",
            "hhf",
            "hhh",
            "hjk",
            "hjn",
            "hola",
            "ibf",
            "ihi",
            "iii",
            "iji",
            "ioj",
            "iph",
            "jaj",
            "jaja",
            "jhg",
            "jhj",
            "jhn",
            "jhr",
            "jhu",
            "jjj",
            "jjn",
            "jkl",
            "jlk",
            "jok",
            "kbe",
            "khv",
            "kjk",
            "kjn",
            "kjs",
            "kkj",
            "kkk",
            "klk",
            "knk",
            "lkh",
            "lkj",
            "llj",
            "lll",
            "lol",
            "luu",
            "mkk",
            "mmm",
            "mpm",
            "nalga",
            "nel",
            "njp",
            "nkj",
            "nnn",
            "nomb",
            "nul",
            "oif",
            "oio",
            "ooo",
            "ouo",
            "paa",
            "personal",
            "pito",
            "ppp",
            "qqq",
            "qwe",
            "rgt",
            "rrr",
            "rtr",
            "sda",
            "sdf",
            "sds",
            "sfj",
            "sss",
            "sws",
            "trial",
            "trr",
            "trt",
            "ttt",
            "uuu",
            "vee",
            "vvv",
            "wfe",
            "www",
            "xcv",
            "xde",
            "xxx",
            "xzz",
            "yrt",
            "yyy",
            "zxc",
            "zye",
            "zzz",
            "none",
            "asas",
            "fds",
            "jnk",
            "jll",
            "rrb",
            "perra",
            "puta",
            "culo",
            "culiada",
            "marica",
            "mamar",
            "puto",
            "pendejo",
            "ldk",
            "xoxo",
            "ramera",
            "hff",
            "verga",
            "maricon",
            "campell",
            "eqtynhxfdm",
            "qwrqwweq",
            "dfhjgjm",
            "eewer",
            "jklyg",
            "asrfggd",
            "hhsdfdgddh",
            "qwert",
            "kjhgf",
            "abcde12345",
            "12356hgtght",
            "qwde",
            "facebook",
            "haqed",
            "hormail",
            "homail",
            "gamil",
            "cdnqa",
            "hitmail",
            "einrot",
            "gmial",
            "gmil",
            "hotmial",
            "superrito",
            "drisd",
            "htomail",
            "hotmil",
            "hotmal",
            "gamail",
            "goeqa",
            "dayrep",
            "jotmail",
            "outlok",
            "armyspy",
            "fleckens",
            "gustr",
            "jourrapide",
            "rhyta",
            "teleworm",
            "kmhow",
            "zoho",
            "hptmail",
            "hoymail",
            "htmail",
            "hotnail",
            "yopmail",
            "my10minutemail",
            "yomail",
            "20email",
            "trbvn",
            "10minutemail",
            "swift10minutemail",
            "mailinator",
            "meltmail",
            "TempEMail",
            "filzmail",
            "sharklasers",
            "guerrillamail",
            "grr",
            "guerrillamailblock",
            "spam4",
            "novalido"
        ];

        $return = array_search($text, $basura);

        return $return;
    }

    function letrasRepetidas($name){

        $d=preg_match("/a{3,10}|b{3,10}|c{3,10}|d{3,10}|e{3,10}|f{3,10}|g{3,10}|h{3,10}|i{3,10}|j{3,10}|k{3,10}|l{3,10}|m{3,10}|n{3,10}|o{3,10}|p{3,10}|w{3,10}|r{3,10}|s{3,10}|t{3,10}|u{3,10}|v{3,10}|w{3,10}|x{3,10}|y{3,10}|z{3,10}/",$name);
        if($d){
         return true;
        }else{
            return false;
        }
    }

    function countLetter($name)
    {
        $count = strlen($name);
        if($count < 3){
         return true;
        }else{
            return false;
        }
    }
}
