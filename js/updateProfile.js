//for Login
var changed = false;

let warningText = document.getElementById("warningText");

function checkUpdate(event) {
    event.preventDefault();
    
    let image = document.getElementById("InputProfilePicture").files[0];
    let name = document.getElementById("InputName").value;
    let bio = document.getElementById("InputBio").value;
    
    let formData = new FormData();
    formData.append('image', image);
    formData.append('name', name);
    formData.append('bio', bio);
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'profile.php', true);
    xhr.onload = function () {
        
        ChangeText(warningText, "Profile Updated");

        changed = false;
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

document.getElementById("InputName").addEventListener("keyup", function() {
    changed = true;
});

document.getElementById("InputBio").addEventListener("keyup", function() {
    changed = true;
});

document.getElementById("InputProfilePicture").addEventListener("change", function() {
    changed = true;
});

window.addEventListener("beforeunload", function(event) {
    if (changed) {
        event.preventDefault();
    }
});

