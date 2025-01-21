const container = document.querySelector('.container');
const adminBtn = document.querySelector('.admin-btn');
const loginBtn = document.querySelector('.login-btn');

if (adminBtn && loginBtn) {
    adminBtn.addEventListener('click', () => {
        container.classList.add('active');
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove('active');
    });
} 

else {
    console.error('Buttons not found in the document!');
}