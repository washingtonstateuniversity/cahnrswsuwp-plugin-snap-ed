<div class="profile-contact-table-row" role="row">
    <?php if ( 'team-table' !== $settings['display'] ) : ?><div class="contact-region profile-contact-table-column" role="gridcell" aria-labelledby="a1"><?php echo esc_html( $region ); ?></div><?php endif; ?>
    <div class="contact-group profile-contact-table-column" role="gridcell" aria-labelledby="a2"><?php echo esc_html( $affiliation ); ?></div>
    <div class="contact-name profile-contact-table-column" role="gridcell" aria-labelledby="a3"><?php echo esc_html( $name ); ?></div>
    <div class="contact-position profile-contact-table-column" role="gridcell" aria-labelledby="a4"><?php echo esc_html( $position_title ); ?></div>
<div class="contact-email profile-contact-table-column" role="gridcell" aria-labelledby="a5"><?php if ( ! empty( $email ) ) : ?><a href="mailto:<?php echo esc_html( $email ); ?>"><?php echo esc_html( $email ); ?></a><?php endif; ?></div>
    <div class="contact-phone profile-contact-table-column" role="gridcell" http://local-dev.com/people/="a6"><?php echo esc_html( $phone); ?></div>
</div>