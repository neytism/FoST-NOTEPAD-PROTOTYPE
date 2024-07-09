//for Login

let warningText = document.getElementById("warningText");

function checkLogin(event) {
    event.preventDefault();
    
    let uname = document.getElementById("InputUsername").value;
    let pword = document.getElementById("InputPassword").value;
  
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'loginAction.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        
        if(this.responseText == "success"){
            
            ChangeText(warningText, "Redirecting you to home page...");
            setTimeout(function(){
                document.location.href = 'index.php';
           }, 1000); 
        
        } else{
            ChangeText(warningText, this.responseText);
        }
    };
    
    xhr.send('uname=' + uname + '&pword=' + pword);
  
  };
  
  function ChangeText(textHolder, textString) {
    
    textHolder.style.display = "block";
    textHolder.innerHTML = textString;
}
