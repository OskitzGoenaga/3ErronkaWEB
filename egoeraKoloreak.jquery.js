        $(document).ready(function () {
            $(".egoera").each(function () {
                var egoera = $(this).text().trim();

                if (egoera == "Izen ematen") {
                    $(this).css("background", "rgba(42,107,69,0.2)");
                    $(this).css("color", "#5dba85");
                } else if (egoera == "Amaituta") {
                    $(this).css("background", "rgba(135, 41, 22, 0.46)");
                    $(this).css("color", "#b86b5d");
                } else {
                    $(this).css("background", "rgba(190, 166, 45, 0.46)");
                    $(this).css("color", "#cdd189");
                }
            });
        });