<div class="wedevs-contact-form" id="wedevs-contact-form">

    <form action="" method="post">

        <div class="form-row">
            <label for="name"><?php _e( 'Name', 'wedevs-academy' ); ?></label><br />

            <input type="text" id="name" name="name" value="" required>
        </div>

        <div class="form-row">
            <label for="email"><?php _e( 'E-Mail', 'wedevs-academy' ); ?></label> <br />

            <input type="email" id="email" name="email" value="" required>
        </div>

        <div class="form-row">
            <label for="message"><?php _e( 'Message', 'wedevs-academy' ); ?></label><br />

            <textarea name="message" id="message" required></textarea>
        </div>

        <div class="form-row">

            <?php wp_nonce_field( 'wd-ac-contact-form' ); ?>

            <input type="hidden" name="action" value="wd_ac_academy_contact">
            <input type="submit" name="send_contact" value="<?php esc_attr_e( 'Send', 'wedevs-academy' ); ?>">
        </div>

    </form>
</div>