
<div class="wrap">
    <h1><?php _e('Edit Address', 'wedevs-academy'); ?></h1>

    <?php if ( isset( $_GET[ 'updated' ] ) ) { ?>
        <div class="notice notice-success">
            <p>
                <?php _e( 'Address updated successfully', 'wedevs-academy' ); ?>
            </p>
        </div>
    <?php } ?>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row <?php echo $this->has_error( 'name' ) ? 'form-invalid' : ''; ?>">
                    <th>
                        <label for="name"><?php _e('Name', 'wedevs-academy'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="description error" value="<?php echo esc_attr( $address->name ); ?>" />
                        <?php if ( $this->has_error( 'name' ) ){ ?>
                            <p class="description error"><?php echo $this->get_error( 'name' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>
                
                <tr class="row <?php echo $this->has_error( 'phone' ) ? 'form-invalid' : ''; ?>">
                    <th>
                        <label for="phone"><?php _e('phone', 'wedevs-academy'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="phone" id="phone" class="description error" value="<?php echo esc_attr( $address->phone ); ?>" />
                        <?php if ( $this->has_error( 'phone' ) ){ ?>
                            <p class="description error"><?php echo $this->get_error( 'phone' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>

                <tr class="row <?php echo $this->has_error( 'address' ) ? 'form-invalid' : ''; ?>">
                    <th>
                        <label for="address"><?php _e('Address', 'wedevs-academy'); ?></label>
                    </th>
                    <td>
                        <input type="text" name="address" id="address" class="tegular-text" value="<?php echo esc_attr( $address->address ); ?>" />
                        <?php if ( $this->has_error( 'address' ) ){ ?>
                            <p class="description error"><?php echo $this->get_error( 'address' ); ?></p>
                        <?php } ?>
                    </td>
                </tr>

            </tbody>
        </table>
        
        <input type="hidden" name="id" value="<?php echo esc_attr( $address->id ); ?>" />
        <?php wp_nonce_field('new-address'); ?>
        <?php submit_button(__( 'Save Address', 'wedevs-academy' ), 'primary', 'submit_address'); ?>
    </form>
</div>