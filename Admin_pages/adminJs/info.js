
function shwoInfo(id, rendered) {
    var id = id;
    document.getElementById(id).style.color = "green";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("mainContentdiv").innerHTML = xhr.responseText;
        }
    };
    xhr.open("GET", rendered);
    xhr.send();
}

 

































// function showAdminIno() {
//     document.getElementById("showAdminInfo").style.color = "green";
//     var xhr = new XMLHttpRequest();
//     xhr.onreadystatechange = function () {
         
//         if (xhr.readyState == 4 && xhr.status == 200) {
           
//             document.getElementById("loadContentDiv").innerHTML = xhr.responseText;
//         }
        
//         xhr.open("GET", "showAdminInfo.php");
//         xhr.send();
//     };
    
             
    
// }

// function showUserInfo() {
//     document.getElementById("showUserInfo").style.color = "green";
//     var xhr = new XMLHttpRequest();
//     xhr.onreadystatechange = function () {
         
//         if (xhr.readyState == 4 && xhr.status == 200) {
           
//             document.getElementById("loadContentDiv").innerHTML = xhr.responseText;
//         }
        
//         xhr.open("GET", "showUserInfo.php");
//         xhr.send();
//     };
    
             
    
// }

// function depositBalance() {
//     document.getElementById("depositBalance").style.color = "green";
//     var xhr = new XMLHttpRequest();
//     xhr.onreadystatechange = function () {
         
//         if (xhr.readyState == 4 && xhr.status == 200) {
           
//             document.getElementById("loadContentDiv").innerHTML = xhr.responseText;
//         }
        
//         xhr.open("GET", "depositBalance.php");
//         xhr.send();
//     };
    
             
    
// }
// function addMovie() {
//     document.getElementById("depositBalance").style.color = "green";
//     var xhr = new XMLHttpRequest();
//     xhr.onreadystatechange = function () {
         
//         if (xhr.readyState == 4 && xhr.status == 200) {
           
//             document.getElementById("loadContentDiv").innerHTML = xhr.responseText;
//         }
        
//         xhr.open("GET", "addMovie.php");
//         xhr.send();
//     };
    
             
    
// }


