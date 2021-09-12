function setLogin(){
    username= document.getElementById('username').value;
    password= document.getElementById('password').value;
    
    $.ajax({
        type:'get',
        url:'./php/setlogin.php',
        data:{
            username:username,
            password:password
        },
        success:function(response){
            if(response =='agent'){
                window.location.href="./"
            }else if(response =='admin'){
                window.location.href="./admin/"
            }else if(response =='cred'){
                toastr.error("Invalid Credentials");
            }else{
                toastr.error("User is disabled");
            }
        }
    });
    return false;
}