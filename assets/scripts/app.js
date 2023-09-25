/*
|-------------------------------------------------------------------
| ****************** WHEN USER CLICKS ANYWHERE *********************
|-------------------------------------------------------------------
*/
$(document).on("click", function (event) {
  if (
    !$(event.target).closest(".filters_lists_container").length &&
    !$(event.target).closest(".open_filters_btn").length
  ) {
    $(".filters_lists_container").hide();
  }
});
/*
|-------------------------------------------------------------
| ****************** FILTER INTERACTIONS *********************
|-------------------------------------------------------------
*/
$("body").on("click", ".open_filters_btn", (e) => {
  let show_content = $(e.currentTarget).attr("filter_data"),
    button_data = $(e.currentTarget).attr("btn_data");
  $(".filter_save_buttons .btn").attr("filter_data", button_data);
  $(".filter_save_buttons .btn").attr("div_data", show_content);
  $(".filters_content").hide();
  $(show_content).show();
  display_div_at_cursor($(".filters_lists_container"), e);
});
$("body").on("click", ".filter_save_buttons .apply_btn", (e) => {
  let filtered_element = $(e.currentTarget).attr("filter_data"),
    filtered_element_div = $(e.currentTarget).attr("div_data"),
    applied_filters_array = $(filtered_element_div)
      .find("input[type='checkbox']")
      .filter(":checked")
      .map(function () {
        return $(this).attr("data_filter");
      })
      .get(),
    fields = {"page":1};
  console.log(applied_filters_array);
  console.log(filtered_element);
  fields[filtered_element] = applied_filters_array.join(",");
  update_filter_url(fields);
});
/*
|----------------------------------------------------
| ****************** UTILITIES *********************
|----------------------------------------------------
*/
function display_div_at_cursor(div_element, e) {
  div_element.hide();
  var screenWidth = $(window).width();
  var screenHeight = $(window).height();
  var containerWidth = div_element.outerWidth();
  var containerHeight = div_element.outerHeight();
  var leftPosition = e.pageX;
  var topPosition = e.pageY;
  // Check if the div overflows with the screen
  if (leftPosition + containerWidth > screenWidth) {
    leftPosition = Math.max(e.pageX - containerWidth, 0);
  }
  if (topPosition + containerHeight > screenHeight) {
    topPosition = Math.max(e.pageY - containerHeight, 0);
  }
  div_element
    .css({
      position: "absolute",
      left: leftPosition,
      top: topPosition,
      // display: 'block'
    })
    .fadeIn(350);
}
function update_filter_url(fields) {
  // let currentUrl = window.location.href;
  const urlSearchParams = new URLSearchParams(window.location.search);
  $.each(fields, (filter_key, filter_value) => {
    urlSearchParams.set(filter_key, filter_value);
  });

  // Replace the current URL with the updated one
  history.replaceState(null, null, "?" + urlSearchParams.toString());
}

// alert("APPPP");
