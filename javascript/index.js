console.log("hiii");


// code for menu() function that will toggle the menu bar in small devices 
function menu() 
{
    // console.log("icon clicked");
    let x=document.getElementById("id-header-right");
    if(x.style.display == "flex")
    {
        x.style.display="none";
        console.log("menu hide");
    }
    else
    {
        x.style.display="flex";
        console.log("menu show");
    }
}

// code for closing the login error 
function closeLoginError()
{
    let x=document.querySelector("#notification-id");
    x.style.display="none";

}

// code for closing the success 
function closeSignupSuccess()
{
    let x=document.querySelector("#notification-success-id");
    x.style.display="none";

}