<?php
// Add meta box for 'dwk-image-maping' post type
function add_heart_buyer_meta_box() {
  add_meta_box(
      'heart_buyer_meta_box', // Meta box ID
      'Stone Heart Buyer', // Title of the meta box
      'render_heart_buyer_meta_box', // Function to display the meta box content
      'dwk-image-maping', // Post type to display the meta box
      'normal', // Context
      'high' // Priority
  );
}
add_action('add_meta_boxes', 'add_heart_buyer_meta_box');

// Render content for the 'heart_buyer_meta_box' meta box
function render_heart_buyer_meta_box($post) {
  // Retrieve existing meta data
  $heart_buyer = get_post_meta($post->ID, 'heart_buyer', true);
  ?>
  <label for="heart_buyer">Name of  Stone Heart Buyer:</label>
  <input type="text" id="heart_buyer" name="heart_buyer" value="<?php echo esc_attr($heart_buyer); ?>" style="width: 100%;" />
  <?php
}

// Save meta box data
function save_heart_buyer_meta_data($post_id) {
  // Check if this is an autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

  // Check if the user has permissions to save data
  if (!current_user_can('edit_post', $post_id)) return;

  // Save heart buyer data
  if (isset($_POST['heart_buyer'])) {
      update_post_meta($post_id, 'heart_buyer', sanitize_text_field($_POST['heart_buyer']));
  } else {
      delete_post_meta($post_id, 'heart_buyer');
  }
}
add_action('save_post', 'save_heart_buyer_meta_data');
