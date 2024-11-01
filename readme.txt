=== BuddyPress Groups Integration for WooCommerce ===
Contributors: themekraft, svenl77, gfirem
Tags: buddypress, buddypress groups, woocommerce, e-commerce, woocommerce groups
Requires at least: 4.0
Tested up to: 6.0.1
Stable tag: 1.4.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

BuddyPress Groups Integration for WooCommerce , integrate BuddyPress Groups with WooCommerce and WooCommerce Subscription. Ideal for subscription and membership sites such as premium support.

== Description ==

The best solution to [Integrate BuddyPress Groups with WooCommerce](https://themekraft.com/create-groups-purchased-products-woocommerce/) which is perfect for any subscription and membership site or if you are offering premium support. The plugin takes a WooCommerce product to handle the membership of your WooCommerce customers into existing BuddyPress Groups.

### Manage the group's membership in the product editing screen:
1. Auto join members to groups after the payment is completed.
2. Allow customers to select the related group(s) they would like to join that before adding the product to the cart.

---

### Addons

> * [Shop solution for your BuddyPress community. Integrates a WooCommerce installation with a BuddyPress social network.](https://wordpress.org/plugins/wc4bp)
> * [BuddyPress xProfile Checkout Manager for WooCommerce: Add your BuddyPress Profile Fields into the WooCommerce Checkout. Customize your WooCommerce Checkout field and remove unwanted fields for example "phone number" from the checkout form.](https://wordpress.org/plugins/woocommerce-buddypress-integration-xprofile-checkout-manager/)
> * [BuddyPress Subscriptions for WooCommerce: Integrate BuddyPress with WooCommerce Subscription. Ideal for subscription and membership sites such as premium support.](https://themekraft.com/products/buddypress-woocommerce-subscriptions-integration/)

---

### Product Support
Add your customers to a private support group after the purchase is complete and enable premium product support on your site.

---

### Public and Private Groups
* Let your customers select group membership for public and private groups around the product.
* Auto join your customers to public and private groups which you can configure in the product editing screen.

---

### Membership Levels
Predefine the membership Level ( Moderator, Admin, Normal ) that your user will become in the group.

---

== Frequently Asked Questions ==

= Dependencies =
This addon need the [BuddyPress Groups Integration for WooCommerce](https://wordpress.org/plugins/wc4bp/) with the Professional Plan.


== Screenshots ==
1. Product Edit Screen
2. Product Single View
3. In the Card
4. Checkout Complete
5. In the eMail

== Installation ==
1. Download the plugin
2. Upload to wp-content/plugins/
3. Activate in the backend
4. Done ;)

== Changelog ==
= 1.4.7 - 16 Aug 2022 =
* Fixed vulnerability issue.
* Updated plugin name.
* Tested up to WordPress 6.0.1

= 1.4.6 - 17 May 2022 =
* Updated readme.txt

= 1.4.5 - 29 Mar 2022 =
* Tested up to WordPress 5.9
* Tested up to Woocommerce 6.3.1

= 1.4.4 - 21 Sep 2021 = 
* Fixed error when deleting products from an existing order.
* Tested up with WordPress 5.8

= 1.4.3 - 10 May 2021 = 
* Fixed WooCommerce deprecation on the on_process_complete function.
* Fixed on the "Add Member to Group" proccess to avoid exceptions if the activity component it's disabled.

= 1.4.2 - 29 Mar 2021 =
* Fixed issue (hotfix) related with visible PHP code inside Front-end views.

= 1.4.1 - 7 Jan 2021 =
* Change name to WooBuddy -> Groups
* Tested up with WordPress 5.7
* Tested up with WC 5.1.0

= 1.4.0 - 30 March 2020 =
* Added support for Woocommerce Subscription.

= 1.3.5 - 15 Jan 2020 =
* Fixed the error trigger when the code was executed with an empty product.

= 1.3.4 1 Oct 2019 =
* Added support for Unicode characters, thanks to `Ju Hyung Kang` we start supporting Korean.

= 1.3.3 29 May 2019 =
* Fixed minor issue to avoid a notice in the product details in the frontend when the groups are optional.

= 1.3.2 =
* Fixed a Typo in the requirement message.

= 1.3.1 =
* Added a hook to not show the tab content in the product page. `wc4bp_groups_show_product_tab`

= 1.3.0 =
* Integrating with the product variations types.

= 1.2.1 =
* Adding custom message to check dependency.
* Changing the requirement library to use a custom internal id.

= 1.2.0 =
* Testing with the last version of Woo.
* Adding Woo support tags.

= 1.1.1 =
* Changing the requirement text for generic one.

= 1.1.0 =
* Adding a trigger option to select when the user will be added to the desire group.
* Fixing some typos and dependency.
* Cleaning the code.

= 1.0.6 =
* Removing freemius to use the same from the core.

= 1.0.5 =
* Updating the loaded freemius to use it form core
* Improve the messages for requirement library

= 1.0.4 18. July 2017 =
* Remove the changelog.txt. Its located in eh readme.txt
* Integrating with WooCommerce BuddyForms Form Elements.
* Cleaning up the code.
* Updating freemius
* fixing the global freemius variable
* Idealizing the log class to get messages into activity log

= 1.0.3 =
Improving the requirement library
Updated Freemius
Readme changes and plugin uri
Multiple smaller fixes

= 1.0.2 =
Added freemius addon support to start only when the parent is activated
Implementing a function to process the item meta in the thank you page

= 1.0.1 =
* update freemius to the correct plugin id and public key

= 1.0.0 =
* first public version
