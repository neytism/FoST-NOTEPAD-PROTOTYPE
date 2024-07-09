//for Login

let warningText = document.getElementById("warningText");

function checkSignup(event) {
    event.preventDefault();
    
    let uname = document.getElementById("InputUsername").value;
    let image = document.getElementById("InputProfilePicture").files[0];
    let name = document.getElementById("InputName").value;
    let bio = document.getElementById("InputBio").value;
    let pword = document.getElementById("InputPassword").value;
    let rpword = document.getElementById("InputRepeatPassword").value;
    
    let formData = new FormData();
    formData.append('uname', uname);
    formData.append('image', image);
    formData.append('name', name);
    formData.append('bio', bio);
    formData.append('pword', pword);
    formData.append('rpword', rpword);
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'signupAction.php', true);
    xhr.onload = function () {
        
        if (this.responseText == "success") {
            
            ChangeText(warningText, "Redirecting you to home page...");
            setTimeout(function () {
                document.location.href = 'index.php';
            }, 1000);

        } else {
            ChangeText(warningText, this.responseText);
            //console.log(this.responseText);
        }
    };
    
    xhr.send(formData);
    for (var pair of formData.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
};


document.getElementById('InputProfilePicture').addEventListener('change', function (event) {
    const input = event.target;
    const file = input.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('displayImage').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

function ChangeText(textHolder, textString) {
    
    textHolder.style.display = "block";
    textHolder.innerHTML = textString;
}
