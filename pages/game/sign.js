window.onload = function () {
    window.alert('hello in sign up page');
    console.log('sign up');

    let password = document.querySelector('#password');
    let check = document.querySelector('#check');

    check.addEventListener('change', function () {
        password.type=check.checked?'text':'password';
    });

    password.addEventListener('input', function() {
        let val = password.value;
        let strength = '';
        if (val.length < 6) {
            strength = 'Very Weak ❌';
        }else if (
            val.match(/[a-z]/) &&
            val.match(/[A-Z]/) &&
            val.match(/[0-9]/) &&
            val.length >= 8
        ) {
            strength = 'Strong✔️ ';
        } else {
            strength = 'Medium ⚠️';
        }
        document.getElementById("strengthMessage").textContent = strength;
        console.log(strength);
    });
};


   
  

