<?php

namespace App\Http\Controllers\WebService;




use DB;
use App\Rol;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolController extends Controller
{
    /**
     *
     * HEADER $token
     *
     * @Rest\Get("/landing_rol")
     * @Rest\View
     * @return array
     *
     */
    public function getRoles($user_id){
        $datos = DB::table('usuario')
                 ->join('rol_landing','usuario.rol','=','rol_landing.RolID')
                 ->where('usuario.DomainName',$user_id)
                 ->select(
                     'rol_landing.Landingname as landing',
                     'rol_landing.Landingurl as landing_url'
                 )->get();
         return response()->json($datos, 200);
    }

    public function getRolUser($user_id){
        $datos = DB::table('usuario')
                 ->join('rol_landing','usuario.rol','=','rol_landing.RolID')
                 ->where('usuario.DomainName',$user_id)
                 ->select(
                     'rol_landing.Rolidname as rol_name',
                     'rol_landing.Landingurl as landing_url'
                 )->get();
         return response()->json($datos, 200);
    }

    /**
     *
     * HEADER $token
     *
     * @Rest\Get("/token2")
     * @Rest\View
     * @return array
     *
     */
    public function getToken2(){
         $datos = array('code' => 200, 'msg'=> "ejeomplo ");
        return response()->json($datos, 200);
    }
 
    public function getToken(Request $resquet){
        $codigo = $resquet->code;
        /////////////////////////////////////////////
        // url de configuración para prod o debug  //
        /////////////////////////////////////////////

        $url_debug = "http://localhost:4200";
        $url_prod = "https://app.devmx.com.mx";
        $connection_url = $url_prod;
        $fields = array(
            
        "grant_type"  => "authorization_code",
        "client_secret" => "mWw%2Fj1%2BeTbz86imXoTueZAxO8UxatD69KQwAWRcWFgs%3D",        
        "client_id" => "8b121322-84ec-4bb9-8929-6c64333775f6",
        "resource" => "https://laulatammxqa.crm.dynamics.com",
        "redirect_uri" =>  $connection_url,
        "code" => $codigo,
        );
        
        $ch = curl_init();        
        $postvars = '';

        foreach($fields as $key=>$value) {
            $postvars .= $key . "=" . $value . "&";
        }
          
        $url = "https://login.microsoftonline.com/346a1d1d-e75b-4753-902b-74ed60ae77a1/oauth2/token";
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
        //curl_setopt($ch,CURLOPT_TIMEOUT, 20);
        $response = curl_exec($ch);
        if(!empty($response)){
            $co = json_decode($response); 
            header('location:'. $connection_url.'/?access_token='. $co->access_token);  
            return response()->json('Deberia regresar', 200);
        }else{
            header('location:'. $connection_url);  

            return response()->json('hub error', 200);

        }
        
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getTest(){
        $datos = array('code' => '3000', 'message'=> 'prueba');
        return response()->json($datos, 200);
    }
}
