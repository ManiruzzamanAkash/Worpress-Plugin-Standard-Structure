<div class="wrap">
    <h1><?php _e('New Address', 'wedevs-academy'); ?></h1>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr>
                    <th>
                        <label for="name"><?php _e('Name', 'wedevs-academy'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="tegular-text" value="" />
                        <?php echo isset( $this->errors['name'] ) ? "<p class='text-danger'>". $this->errors[ 'name' ]."</p>" : ''; ?>
                    </td>
                </tr>
                
                <tr>
                    <th>
                        <label for="phone"><?php _e('phone', 'wedevs-academy'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="phone" id="phone" class="tegular-text" value="" />
                        <?php echo isset( $this->errors['phone'] ) ? "<p class='text-danger'>". $this->errors[ 'phone' ]."</p>" : ''; ?>
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="address"><?php _e('Address', 'wedevs-academy'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="address" id="address" class="tegular-text" value="" />
                        <?php echo isset( $this->errors['address'] ) ? "<p class='text-danger'>". $this->errors[ 'address' ]."</p>" : ''; ?>
                    </td>
                </tr>

            </tbody>
        </table>
        <?php wp_nonce_field('new-address'); ?>
        <?php submit_button(__( 'Add Address', 'wedevs-academy' ), 'primary', 'submit_address'); ?>
    </form>
</div>