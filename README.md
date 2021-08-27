### Easy Coupons

Easy Coupons WordPress Plugin for test evaluation purpose

## Installation

This section describes how to install the plugin and get it working.

e.g.

- Upload `easy-coupons.php` to the `/wp-content/plugins/` directory
- Activate the plugin through the 'Plugins' menu in WordPress
- Place `<?php do_action('plugin_name_hook'); ?>` in your templates

## Todos 

- [x] Create a plugin called "Easy Coupons" with the following features:
  - [x] As an admin, I should be able to bulk generate any quantity of randomly generated, unique 4 character alpha-numeric coupon codes (ex. f5Ba, 891d, etc.)
  - [x] As an admin, I should be able to search and delete any individual coupon code
  - [x] As an admin, I should be able to specify an expiry date when I generate coupon codes
  - [x] As an admin, I should be able to bulk delete coupons based on expiry date
- [ ] Create a page with 3 gated educational YouTube videos
  - [ ] As a visitor, to unlock and display a single video I should be able to enter a single valid coupon code (found in the database and future expiry)
  - [ ] As a visitor, I should receive an error message if I attempt to use the same coupon code more than once
  - [ ] As a visitor, I should continue to have access to a video after I enter a valid coupon code (even if I close the browser and return to the site)
  - [ ] As an admin, I should be able to see which video a coupon code was applied to
  - [ ] As an admin, I should see a report of failed coupon code validations with two categories: not found & already used
  - [ ] As an admin, I should be able to use the coupon code ADMN unlimited times to access any video
- [ ] Testing
  - [ ] As a developer, I should be able to test any business logic with automated unit tests
- [ ] Styling
  - [ ] Create a custom WP theme with the stylesheet of your choice
  - [ ] Add animation to the success and failure states of entering a coupon
- [ ] Documentation
  - [ ] Add code comments as needed to improve the ability for another developer to finish this project
  - [ ] Update the README with a brief written summary of what's been completed and what still needs to be done
  - [ ] Update the README Any other feedback including which features could be refactored or improved
