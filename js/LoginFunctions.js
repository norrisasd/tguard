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
            if(response){
                window.location.href="./"
            }else{
                toastr.error("Invalid Credentials");
            }
        }
    });
    return false;
}