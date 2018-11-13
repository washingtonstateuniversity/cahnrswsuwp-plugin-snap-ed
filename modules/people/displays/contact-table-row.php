<div class="profile-contact-table-row">
    <div class="contact-region profile-contact-table-column"><?php echo esc_html( $region ); ?></div>
    <div class="contact-group profile-contact-table-column"><?php echo esc_html( $affiliation ); ?></div>
    <div class="contact-name profile-contact-table-column"><?php echo esc_html( $name ); ?></div>
    <div class="contact-position profile-contact-table-column"><?php echo esc_html( $position_title ); ?></div>
<div class="contact-email profile-contact-table-column"><?php if ( ! empty( $email ) ) : ?><a href="mailto:<?php echo esc_html( $email ); ?>"><?php echo esc_html( $email ); ?></a><?php endif; ?></div>
    <div class="contact-phone profile-contact-table-column"><?php echo esc_html( $phone); ?></div>
</div>