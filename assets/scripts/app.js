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
  if (button_data != "Order") {
    $(".filter_save_buttons").show();
    $(".filter_save_buttons .btn").attr("filter_data", button_data);
    $(".filter_save_buttons .btn").attr("div_data", show_content);
  } else {
    $(".filter_save_buttons").hide();
  }
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
    fields = { page: 1 };
  console.log(applied_filters_array);
  console.log(filtered_element);
  fields[filtered_element] = applied_filters_array.join(",");
  update_filter_url(fields);
  location.reload();
});
$("body").on("click", ".filter_save_buttons .default_btn", (e) => {
  let filtered_element = $(e.currentTarget).attr("filter_data"),
    filtered_element_div = $(e.currentTarget).attr("div_data"),
    fields = { page: 1 };
  $(filtered_element_div).find("input[type='checkbox']").prop("checked", false);
  fields[filtered_element] = "";
  update_filter_url(fields);
  location.reload();
});
$("body").on("click", ".search_btn", (e) => {
  let search_value = $("#search_input").val();
  update_filter_url({ page: 1, Search: search_value });
  location.reload();
});
$("body").on("click", ".order_option_btn", (e) => {
  let filter_data = $(e.currentTarget).attr("data_order");
  update_filter_url({ page: 1, Order: filter_data });
  location.reload();
});
$("body").on("click", ".offer_card.offer_btn", (e) => {
  if (!$(e.target).closest(".btn").length && !$(e.target).closest("a").length) {
    let offer_id = $(e.currentTarget).closest(".offer_card").attr("offer_id"),
      offer_city = $(e.currentTarget).find(".city_value").text(),
      offer_job = $(e.currentTarget).find(".job_value").text(),
      offer_contract = $(e.currentTarget).find(".contract_value").text(),
      offer_enterprise = $(e.currentTarget).find(".card-footer a").text();
    console.log(offer_city);
    $(".offer_details").show();
    $(".offer_details").css("width", "100%");
    $(".offers_list").css("width", "auto");
    $.ajax({
      credentials: "same-origin",
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: "actions/Ajax/load_table_data.php",
      method: "post",
      data: {
        tableName: "offers",
        id: offer_id,
      },
      success: (result) => {
        result = JSON.parse(result)[0];
        console.log(result);
        $(".offer_details .offer_title").html(result["offer_title"]);
        $(".offer_details .reference_value").html("#" + result["reference"]);
        $(".offer_details .desc_value").html(result["offer_description"]);
        $(".offer_details .city_value").html(offer_city);
        $(".offer_details .contract_value").html(offer_contract);
        $(".offer_details .job_value").html(offer_job);
        $(".offer_details .enterprise_profile_url")
          .attr(
            "href",
            "index.php?page=1&enterprise=" + result["enterprise_id"]
          )
          .html(offer_enterprise);
      },
    });
  }
});
$("body").on("click", ".offer_details", (e) => {
  $(".offer_details").hide();
  $(".offer_details").css("width", "auto");
  $(".offers_list").css("width", "100%");
});
$("body").on("click", ".delete_offer", (e) => {
  if (confirm("Voulez vous supprimer cette offre?")) {
    let offer_id = $(e.currentTarget).attr("offer_id");
    $(".offer_details").hide();
    $(".offer_details").css("width", "auto");
    $(".offers_list").css("width", "100%");
    $.ajax({
      credentials: "same-origin",
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: "actions/Ajax/delete_data.php",
      method: "post",
      data: {
        tableName: "offers",
        id: offer_id,
      },
      success: () => {
        $(e.currentTarget).closest(".offer_card").remove();
      },
    });
  }
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
