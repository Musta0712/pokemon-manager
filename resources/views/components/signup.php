<!-- Formulario de Signup -->
<div class="container">
    <div class="form-container">
        <h2>Crear Cuenta</h2>
        <form action="<?=$_SERVER["PHP_SELF"] ?>" method="post" id="signupForm">
            <div class="form-group">
                <label for="fullname">Nombre completo</label>
                <input type="text" id="fullname" name="nombreUsuario" placeholder="Tu nombre completo" value="<?=$nombreUsuario?>" class="<?= empty($nombreUsuarioError) ? "" : "input-error" ?>">
            </div>
            <?= empty($nombreUsuarioError) ? "" : "<p class='p-error'>$nombreUsuarioError</p>" ?>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="tu@email.com" value="<?=$email?>" class="<?= empty($emailError) ? "" : "input-error" ?>">
            </div>
            <?= empty($emailError) ? "" : "<p class='p-error'>$emailError</p>" ?>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Crea una contraseña" class="<?= empty($passwordError) ? "" : "input-error" ?>">
                
                <?php if ($passwordError && (strlen($password) < 6 && !empty($password))): ?>
                    <div class="p-error">La contraseña debe tener al menos 6 caracteres</div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="pass2">Confirmar contraseña</label>
                <input type="password" id="pass2" name="pass2" placeholder="Repite tu contraseña" class="<?= empty($passwordError) ? "" : "input-error" ?>">
                
                <?php if ($passwordError && ($password !== $pass2 && !empty($pass2))): ?>
                    <div class="p-error">Las contraseñas no coinciden</div>
                <?php endif; ?>
            </div>
            <?= empty($passwordError) ? "": "<p class'p-error'>$passwordError</p>" ?>

            
            <button type="submit">Crear Cuenta</button>

            <div class="form-footer">
                ¿Ya tienes cuenta? <a href="/public/form-login.php" id="go-to-login">Inicia Sesión</a>
            </div>

        </form>
    </div>
 </div>