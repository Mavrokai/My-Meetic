document.getElementById('loginForm').addEventListener('submit', async (e) => {

    e.preventDefault();
    const errorDiv = document.getElementById('error-message');

    
    errorDiv.textContent = '';
    errorDiv.classList.remove('error', 'success');

    const formData = new FormData(e.target);
    
    try {
        const response = await fetch(e.target.action, {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            errorDiv.textContent = data.message;
            errorDiv.classList.add('error');
            errorDiv.style.display = 'block';
        }
    } catch (error) {
        errorDiv.textContent = 'Erreur de connexion';
        errorDiv.classList.add('error');
        errorDiv.style.display = 'block';
    }
});