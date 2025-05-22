    </div>    
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        (function () {
            'use strict';
            
            var forms = document.querySelectorAll('.needs-validation');
            
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Add ripple effect to buttons (but don't interfere with form submissions)
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function(e) {
                // Don't apply ripple effect to submit buttons in forms
                if (this.type === 'submit' && this.form) {
                    return; // Let the form submission proceed normally
                }
                
                let x = e.clientX - e.target.offsetLeft;
                let y = e.clientY - e.target.offsetTop;
                
                let ripple = document.createElement('span');
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 1000);
            });
        });

        // Highlight active nav item
        document.addEventListener('DOMContentLoaded', function() {
            const currentPage = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute('href') === currentPage) {
                    link.classList.add('active');
                    link.style.color = 'var(--bright-yellow) !important';
                }
            });
        });
    </script>
</body>
</html>
