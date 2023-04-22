$(document).ready(function () {
  loadPosts(false, false, false, true, true, false, false, false);
});
$("#btn_advance_search").on("click", function () {
  loadPosts(true, true, true, true, true, true, true, true);
});
$("#mbtn_advance_search").on("click", function () {
  loadPosts(true, true, true, true, true, true, true, true);
});
$("#searchTextButton").on("click", function () {
  loadPosts(false, false, false, true, true, false, false, false);
});
$("#search").keydown(function (e) {
  if (e.keyCode === 13) {
    loadPosts(false, false, false, true, true, false, false, false);
  }
});
$("#sort").on("change", function (e) {
  loadPosts(true, true, true, true, true, true, true, true);
});
function loadPosts(
  $byCategories,
  $byType,
  $byDistrict,
  $byTitle,
  $bySort,
  $byDeliver,
  $byBiding,
  $byNegotiable
) {
  let categoriesArray = [];
  let typeArray = [];
  let districtArray = [];
  let search_title = "";
  let sort_type = "";
  let is_Deliver = "";
  let is_Biding = "";
  let is_Negotiable = "";

  if (
    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
      navigator.userAgent
    )
  ) {
    if ($byCategories === true) {
    categoriesArray = [];
      $("input[name='mcategories[]']").each(function () {
        if ($(this).prop("checked")) {
          categoriesArray.push($(this).val());
        }
      });
    }
    if ($byType === true) {
      $("input[name='mtype[]']").each(function () {
        if ($(this).prop("checked")) {
            typeArray.push($(this).val());
        }
      });
    }
    if ($byDistrict === true) {
      $("input[name='mdistrict[]']").each(function () {
        if ($(this).prop("checked")) {
            districtArray.push($(this).val());
        }
      });
    }
    if ($byDeliver === true) {
      is_Deliver = $("#mis_Deliver").is(":checked");
    }

    if ($byBiding === true) {
      is_Biding = $("#mis_Deliver").is(":checked");
    }

    if ($byNegotiable === true) {
      is_Negotiable = $("#mis_Negotiable").is(":checked");
    }
  } else {
    if ($byCategories === true) {
      let categories = document.querySelectorAll(
        'input[name="categories[]"]:checked'
      );
      for (let x = 0, l = categories.length; x < l; x++) {
        categoriesArray.push(categories[x].value);
      }
    }
    if ($byType === true) {
      let type = document.querySelectorAll('input[name="type[]"]:checked');
      for (let x = 0, l = type.length; x < l; x++) {
        typeArray.push(type[x].value);
      }
    }
    if ($byDistrict === true) {
      let district = document.querySelectorAll(
        'input[name="district[]"]:checked'
      );
      for (let x = 0, l = district.length; x < l; x++) {
        districtArray.push(district[x].value);
      }
    }

    if ($byDeliver === true) {
      is_Deliver = $("#is_Deliver").is(":checked");
    }

    if ($byBiding === true) {
      is_Biding = $("#is_Deliver").is(":checked");
    }

    if ($byNegotiable === true) {
      is_Negotiable = $("#is_Negotiable").is(":checked");
    }
  }
  if ($byTitle === true) {
    search_title = $(".search_title").val();
  }
  if ($bySort === true) {
    sort_type = $("#sort").val();
  }

  $.ajax({
    type: "POST",
    url: "datacall/datacalljs.datacall.php",
    dataType: "JSON",
    data: {
      functionname: "postSearch",
      categoriesArray: categoriesArray.length == 0 ? "" :categoriesArray,
      typeArray: typeArray.length == 0 ? "" : typeArray,
      districtArray:  districtArray.length == 0 ? "" :districtArray,
      search_title: search_title,
      sort_type: sort_type,
      is_Deliver: is_Deliver,
      is_Biding: is_Biding,
      is_Negotiable: is_Negotiable,
    },
    success: (status) => {
      $("#text_result_count").html("Showing " + status.length + " results");
      let htmlContent = "";
      for (let i = 1; i <= status.length; i++) {
        let price = new Intl.NumberFormat().format(
          status[i - 1]["total_price"]
        );
        let image = status[i - 1]["image"];
        let title = status[i - 1]["title"];
        let date = status[i - 1]["date"];
        let idwastage = status[i - 1]["idwastage"];
        htmlContent =
          htmlContent +
          '<div class="col-sm">\n' +
          '                                    <div class="card"><img class="card-img-top"\n' +
          '                                                           src="' +
          image +
          '">\n' +
          '                                        <div class="card-body">\n' +
          "                                            <h5><b>" +
          title +
          "</b></h5>\n" +
          '                                            <div class="d-flex flex-row my-2">\n' +
          '                                                <div class="text-muted">Rs.' +
          price +
          "</div>\n" +
          '                                                <div class="w-100 text-right">\n' +
          "                                                    <small>" +
          date +
          "</small>\n" +
          "                                                </div>\n" +
          "                                            </div>\n" +
          '                                            <a href="product_detail.php?id=' +
          idwastage +
          '" class="btn btn-block btn-outline-success rounded my-2">View</a>\n' +
          "                                        </div>\n" +
          "                                    </div>\n" +
          "                                </div>";
      }
      $("#load_post_view").html(htmlContent);
    },
    error: function (xhr, status, error) {
      // var err = eval("(" + xhr.responseText + ")");
      alert(error);
    },
  });
}
Number.prototype.format = function (n, x) {
  var re = "\\d(?=(\\d{" + (x || 3) + "})+" + (n > 0 ? "\\." : "$") + ")";
  return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, "g"), "$&,");
};
