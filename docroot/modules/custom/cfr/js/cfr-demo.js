/**
 * Declares Drupal behaviors for the CFR module.d
 * @type {{attach: Drupal.behaviors.cfr.attach}}
 */
Drupal.behaviors.cfr = {
  attach: function (context) {
    // Activate Data Tables on the CFR demo to provide
    // sorting and (if desired) paging and searching.
    jQuery('#cfr-station-table').DataTable({
      "paging": false,
      "searching": false,
    });
  }
}
