<?php
header("Context-Type: text/html; charset=utf-8");
include("connMySql.php");
$seldb = @mysqli_select_db($db_link, "myuser");
if (!$seldb) {
    die("選擇失敗");
}
require_once("connMySql.php");
$pageRow_records = 4;
$num_pages = 1;
if (isset($_GET['page'])) {
    $num_pages = $_GET['page'];
}
$startRow_records = ($num_pages - 1) * $pageRow_records;
$query_RecBoard = "SELECT * FROM item_data ORDER BY item_id DESC";
$query_limit_RecBoard = $query_RecBoard . "LIMIT {$startRow_records},{$pageRow_records}";
$RecBoard = $db_link->query($query_RecBoard);
$all_RecBoard = $db_link->query($query_RecBoard);
$total_records = $all_RecBoard->num_rows;
$total_pages =  ceil($total_records / $pageRow_records);
$i = 0;
session_start();
@$user = $_SESSION['user'];
@$status = $_SESSION['status'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>傢俱王</title>
    <link href="css/site.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <style>
        .Furniture_container {
            display: inline-flex;
            width: 100%;
            margin: 5px auto 20px;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            flex-direction: row;

        }

        .size_item_1 {
            font-weight: bolder;
            color: darkslategrey;
            border: 2px solid darkkhaki;
            background-color: darkkhaki;
            border-radius: 10px;
            padding: 10px;
            margin: 0px 10px 0px 400px;
            cursor: pointer;
            width: 125px;
            text-align: center;
        }

        .choice {
            font-weight: bolder;
            color: darkslategrey;
            border: 2px solid darkkhaki;
            background-color: ;
            border-radius: 10px;
            padding: 10px;
            cursor: pointer;
            width: auto;
            text-align: center;
        }
    </style>
    <script>
        $(document).ready(function() {

            $('.Furniture').hide();
            $('.size_item_1').click(function() {
                location.reload(true);
            });

            $('.select_item').click(function() {
                $(this).toggleClass("change_color");
                var $x = $(this).text();
                $('.choice').append($x);

            });
            $('.price_item').click(function() {
                $(this).toggleClass("change_color");
                var $y = $(this).text();
                $('.choice').append($y);

            });
            $('.size_item').click(function() {
                $(this).toggleClass("change_color");
                var $z = $(this).text();
                $('.choice').append($z);
            });
            $('.price').hide();
            $('.size').hide();





            $('.select_item').click(function() {
                $('.price').fadeIn();
            });
            $('.price_item').click(function() {
                $('.size').fadeIn();
            });
            $('#select_1').click(function() {

                $('.Furniture_container').show(function() {
                    for (let s1 = 0; s1 < 100; s1++) {
                        if ($('#' + s1).text() == '桌椅') {
                            $('#' + s1).parent().show();
                        } else {
                            $('#' + s1).parent().hide();
                        }
                    }
                });
                $('#price_1').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) < 100 && $('#' + p1).parent().find('.Furniture_category').text() == '桌椅') {
                                $('#' + p1).parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '桌椅' && Number($('#' + y).parent().find('.Furniture_price').text()) < 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '桌椅' && Number($('#' + y).parent().find('.Furniture_price').text()) < 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '桌椅' && Number($('#' + y).parent().find('.Furniture_price').text()) < 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                $('#price_2').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) <= 500 && Number($('#' + p1).text()) >= 100 && $('#' + p1).parent().find('.Furniture_category').text() == '桌椅') {
                                $('#' + p1).parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '桌椅' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 500 && Number($('#' + y).parent().find('.Furniture_price').text()) >= 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '桌椅' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 500 && Number($('#' + y).parent().find('.Furniture_price').text()) >= 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '桌椅' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 500 && Number($('#' + y).parent().find('.Furniture_price').text()) >= 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                $('#price_3').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) > 500 && Number($('#' + p1).text()) <= 1000 && $('#' + p1).parent().find('.Furniture_category').text() == '桌椅') {
                                $('#' + p1 + '').parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '桌椅' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 1000 && Number($('#' + y).parent().find('.Furniture_price').text()) > 500) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '桌椅' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 1000 && Number($('#' + y).parent().find('.Furniture_price').text()) > 500) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '桌椅' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 1000 && Number($('#' + y).parent().find('.Furniture_price').text()) > 500) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                $('#price_4').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) > 1000 && $('#' + p1).parent().find('.Furniture_category').text() == '桌椅') {
                                $('#' + p1 + '').parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '桌椅' && Number($('#' + y).parent().find('.Furniture_price').text()) > 1000) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '桌椅' && Number($('#' + y).parent().find('.Furniture_price').text()) > 1000) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '桌椅' && Number($('#' + y).parent().find('.Furniture_price').text()) > 1000) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                //1
            });
            $('#select_2').click(function() {
                for (let s1 = 0; s1 < 100; s1++) {
                    $('.Furniture_container').show(function() {
                        if ($('#' + s1).text() == '收納') {
                            $('#' + s1).parent().show();
                        } else {
                            $('#' + s1).parent().hide();
                        }
                    });
                }
                $('#price_1').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) < 100 && $('#' + p1).parent().find('.Furniture_category').text() == '收納') {
                                $('#' + p1).parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '收納' && Number($('#' + y).parent().find('.Furniture_price').text()) < 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '收納' && Number($('#' + y).parent().find('.Furniture_price').text()) < 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '收納' && Number($('#' + y).parent().find('.Furniture_price').text()) < 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                $('#price_2').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) <= 500 && Number($('#' + p1).text()) >= 100 && $('#' + p1).parent().find('.Furniture_category').text() == '收納') {
                                $('#' + p1).parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '收納' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 500 && Number($('#' + y).parent().find('.Furniture_price').text()) >= 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '收納' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 500 && Number($('#' + y).parent().find('.Furniture_price').text()) >= 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '收納' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 500 && Number($('#' + y).parent().find('.Furniture_price').text()) >= 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                $('#price_3').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) > 500 && Number($('#' + p1).text()) <= 1000 && $('#' + p1).parent().find('.Furniture_category').text() == '收納') {
                                $('#' + p1 + '').parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '收納' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 1000 && Number($('#' + y).parent().find('.Furniture_price').text()) > 500) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '收納' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 1000 && Number($('#' + y).parent().find('.Furniture_price').text()) > 500) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '收納' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 1000 && Number($('#' + y).parent().find('.Furniture_price').text()) > 500) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                $('#price_4').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) > 1000 && $('#' + p1).parent().find('.Furniture_category').text() == '收納') {
                                $('#' + p1 + '').parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '收納' && Number($('#' + y).parent().find('.Furniture_price').text()) > 1000) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '收納' && Number($('#' + y).parent().find('.Furniture_price').text()) > 1000) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '收納' && Number($('#' + y).parent().find('.Furniture_price').text()) > 1000) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                //2
            });
            $('#select_3').click(function() {
                for (let s1 = 0; s1 < 100; s1++) {
                    $('.Furniture_container').show(function() {
                        if ($('#' + s1).text() == '電器') {
                            $('#' + s1).parent().show();
                        } else {
                            $('#' + s1).parent().hide();
                        }
                    });
                }
                $('#price_1').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) < 100 && $('#' + p1).parent().find('.Furniture_category').text() == '電器') {
                                $('#' + p1).parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '電器' && Number($('#' + y).parent().find('.Furniture_price').text()) < 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '電器' && Number($('#' + y).parent().find('.Furniture_price').text()) < 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '電器' && Number($('#' + y).parent().find('.Furniture_price').text()) < 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                $('#price_2').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) <= 500 && Number($('#' + p1).text()) >= 100 && $('#' + p1).parent().find('.Furniture_category').text() == '電器') {
                                $('#' + p1).parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '電器' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 500 && Number($('#' + y).parent().find('.Furniture_price').text()) >= 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '電器' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 500 && Number($('#' + y).parent().find('.Furniture_price').text()) >= 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '電器' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 500 && Number($('#' + y).parent().find('.Furniture_price').text()) >= 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                $('#price_3').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) > 500 && Number($('#' + p1).text()) <= 1000 && $('#' + p1).parent().find('.Furniture_category').text() == '電器') {
                                $('#' + p1 + '').parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '電器' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 1000 && Number($('#' + y).parent().find('.Furniture_price').text()) > 500) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '電器' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 1000 && Number($('#' + y).parent().find('.Furniture_price').text()) > 500) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '電器' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 1000 && Number($('#' + y).parent().find('.Furniture_price').text()) > 500) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                $('#price_4').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) > 1000 && $('#' + p1).parent().find('.Furniture_category').text() == '電器') {
                                $('#' + p1 + '').parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '電器' && Number($('#' + y).parent().find('.Furniture_price').text()) > 1000) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '電器' && Number($('#' + y).parent().find('.Furniture_price').text()) > 1000) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '電器' && Number($('#' + y).parent().find('.Furniture_price').text()) > 1000) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                //3
            });
            $('#select_4').click(function() {
                for (let s1 = 0; s1 < 100; s1++) {
                    $('.Furniture_container').show(function() {
                        if ($('#' + s1 + '').text() == '其他') {
                            $('#' + s1 + '').parent().show();
                        } else {
                            $('#' + s1).parent().hide();
                        }
                    });
                }
                $('#price_1').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) < 100 && $('#' + p1).parent().find('.Furniture_category').text() == '其他') {
                                $('#' + p1).parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '其他' && Number($('#' + y).parent().find('.Furniture_price').text()) < 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '其他' && Number($('#' + y).parent().find('.Furniture_price').text()) < 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '其他' && Number($('#' + y).parent().find('.Furniture_price').text()) < 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                $('#price_2').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) <= 500 && Number($('#' + p1).text()) >= 100 && $('#' + p1).parent().find('.Furniture_category').text() == '其他') {
                                $('#' + p1).parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '其他' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 500 && Number($('#' + y).parent().find('.Furniture_price').text()) >= 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '其他' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 500 && Number($('#' + y).parent().find('.Furniture_price').text()) >= 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '其他' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 500 && Number($('#' + y).parent().find('.Furniture_price').text()) >= 100) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                $('#price_3').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) > 500 && Number($('#' + p1).text()) <= 1000 && $('#' + p1).parent().find('.Furniture_category').text() == '其他') {
                                $('#' + p1 + '').parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '其他' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 1000 && Number($('#' + y).parent().find('.Furniture_price').text()) > 500) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '其他' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 1000 && Number($('#' + y).parent().find('.Furniture_price').text()) > 500) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '其他' && Number($('#' + y).parent().find('.Furniture_price').text()) <= 1000 && Number($('#' + y).parent().find('.Furniture_price').text()) > 500) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                $('#price_4').click(function() {
                    for (let p1 = 100; p1 < 200; p1++) {
                        $('.Furniture_container').show(function() {
                            if (Number($('#' + p1).text()) > 1000 && $('#' + p1).parent().find('.Furniture_category').text() == '其他') {
                                $('#' + p1 + '').parent().show();
                            } else {
                                $('#' + p1).parent().hide();
                            }
                        });
                    }
                    $('#size_big').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-近全新' && $('#' + y).parent().find('.Furniture_category').text() == '其他' && Number($('#' + y).parent().find('.Furniture_price').text()) > 1000) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_mid').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-良好' && $('#' + y).parent().find('.Furniture_category').text() == '其他' && Number($('#' + y).parent().find('.Furniture_price').text()) > 1000) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                    $('#size_small').click(function() {
                        for (let y = 200; y < 300; y++) {
                            $('.Furniture_container').show(function() {
                                if ($('#' + y).text() == '二手-普通' && $('#' + y).parent().find('.Furniture_category').text() == '其他' && Number($('#' + y).parent().find('.Furniture_price').text()) > 1000) {
                                    $('#' + y).parent().show();
                                } else {
                                    $('#' + y).parent().hide();
                                }
                            });
                        }
                    });
                });
                //4
            });
            $('#price_1').click(function() {
                for (let p1 = 100; p1 < 200; p1++) {
                    $('.Furniture_container').show(function() {
                        if (Number($('#' + p1).text()) < 100) {
                            $('#' + p1).parent().show();
                        } else {
                            $('#' + p1).parent().hide();
                        }
                    });
                }
                //5
            });
            $('#price_2').click(function() {
                for (let p1 = 100; p1 < 200; p1++) {
                    $('.Furniture_container').show(function() {
                        if (Number($('#' + p1).text()) <= 500 && Number($('#' + p1).text()) >= 100) {
                            $('#' + p1 + '').parent().show();
                        } else {
                            $('#' + p1).parent().hide();
                        }
                    });
                }

            });
            $('#price_3').click(function() {
                for (let p1 = 100; p1 < 200; p1++) {
                    $('.Furniture_container').show(function() {
                        if (Number($('#' + p1).text()) > 500 && Number($('#' + p1).text()) <= 1000) {
                            $('#' + p1 + '').parent().show();
                        } else {
                            $('#' + p1).parent().hide();
                        }
                    });
                }
                //7
            });
            $('#price_4').click(function() {
                for (let p1 = 100; p1 < 200; p1++) {
                    $('.Furniture_container').show(function() {
                        if (Number($('#' + p1).text()) > 1000) {
                            $('#' + p1 + '').parent().show();
                        } else {
                            $('#' + p1).parent().hide();
                        }
                    });
                }
                //8
            });
            $('#size_big').click(function() {
                for (let y = 200; y < 300; y++) {
                    $('.Furniture_container').show(function() {
                        if ($('#' + y).text() == '二手-近全新') {
                            $('#' + y).parent().show();
                        } else {
                            $('#' + y).parent().hide();
                        }
                    });
                }
                //9
            });
            $('#size_mid').click(function() {
                for (let y = 200; y < 300; y++) {
                    $('.Furniture_container').show(function() {
                        if ($('#' + y).text() == '二手-良好') {
                            $('#' + y).parent().show();
                        } else {
                            $('#' + y).parent().hide();
                        }
                    });
                }
                //10
            });
            $('#size_small').click(function() {
                for (let y = 200; y < 300; y++) {
                    $('.Furniture_container').show(function() {
                        if ($('#' + y).text() == '二手-普通') {
                            $('#' + y).parent().show();
                        } else {
                            $('#' + y).parent().hide();
                        }
                    });
                }
                //11
            });
            $("#login").click(function() {
                $('#slidebox').slideToggle();
            });
            $('#login').click(function() {
                $('#LoginWrap').show();
            })
            $('#back').click(function() {
                $('#LoginWrap').hide();
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            // $("#login").click(function() {
            //     $('#slidebox').slideToggle();
            // });
            // $('#login').click(function() {
            //     $('#LoginWrap').show();
            // })
            // $('#back').click(function() {
            //     $('#LoginWrap').hide();
            // })
        });
    </script>
</head>

<body>

    <div class="header">
        <?php if ($user == NULL) { ?>
            <div id="div_login"><input type="button" value="登入" onclick="location.href='php/login/login.php'" id="login"></div>
        <?php } else { ?>
            <div id="div_login"><img src="img/member.png" id="login"></div> <?php  } ?>
        <div id="slidebox">
            <center style="display: inline-flex;flex-wrap: wrap;justify-content: space-around;">
                <p id="u_acc">您好! <?php echo $user ?> </p>
                <p id="u_name">您的身分為 : <?php echo $status ?>ER</p>
                <a href="php/item/item_data.php" style="text-decoration:none;color:gray">管理上架商品</a>
                <a href="php/login/member_update.php" style="text-decoration:none;color:gray">修改會員資料</a>
                <a href="php/login/logout.php" style="text-decoration:none;color:gray">登出</a>
            </center>
        </div>


        <div>
            <a href="index.php"><img src="img/傢俱王LOGO.png" alt="LOGO" id="logo"></a>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------- -->
    <div class="container">
        <!--------    置頂menu   -------->
        <div class="row">
            <div class="nav_all">
                <div class="nav_page"><a href="index.php">首頁</a></div>
                <div class="nav_page" style="<?php if ($user == NULL) echo "display: none;";
                                                else {
                                                } ?>"><a href="sell.php">出售傢俱</a></div>
                <div class="nav_page" style="<?php if ($user == NULL) echo "display: none;";
                                                else {
                                                } ?>"><a href="wish.php">許願池</a></div>
                <div class="nav_page" style="<?php if ($user == NULL) echo "display: none;";
                                                else {
                                                } ?>"><a href="message.php">留言</a></div>
            </div>
        </div>
        <!--------    選擇分類   -------->
        <div class="row">
            <div class="select">
                <div class="sub_title">選擇分類</div>
                <div class="select_item" id="select_1">桌椅</div>
                <div class="select_item" id="select_2">收納</div>
                <div class="select_item" id="select_3">電器</div>
                <div class="select_item" id="select_4">其他</div>
            </div>
        </div>
        <!--------    價錢範圍   -------->
        <div class="row">
            <div class="price">
                <div class="sub_title">價錢範圍</div>
                <div class="price_item" id="price_1">$99銅板價</div>
                <div class="price_item" id="price_2">$100~$500</div>
                <div class="price_item" id="price_3">$500~$1000</div>
                <div class="price_item" id="price_4">$1000以上</div>

            </div>
        </div>
        <!--------    尺寸分類   -------->
        <div class="row">
            <div class="size">
                <div class="sub_title">二手程度</div>
                <div class="size_item" id="size_big">近全新</div>
                <div class="size_item" id="size_mid">良好</div>
                <div class="size_item" id="size_small">普通</div>

            </div>
        </div>
        <div class="row">
            <div class="size_item_1" id="restart" style="float:left;">重新選擇</div>
            <div class="choice"></div>
        </div>
        <!--------    商品   -------->
        <div class="title">商品</div>
        <div class="Furniture_container"><?php $i = 0;
                                            $x = 100;
                                            $y = 200; ?>
            <?php while ($row_RecBoard = $RecBoard->fetch_assoc()) { ?>
                <div class="Furniture no1">
                    <div class="Furniture_img"><img src="php/item/upload/<?php echo $row_RecBoard['item_img']; ?>" alt="圖片"></div>
                    <div class="Furniture_name">商品名稱:<?php echo $row_RecBoard['item_name'] ?></div>
                    <div style="float:left;">商品價格:</div>
                    <div class="Furniture_price" style="float:left;" id="<?php print($x);
                                                                            $x++; ?>"><?php echo $row_RecBoard['item_price'] ?></div>
                    <div>元</div>
                    <div style="float:left;">商品分類:</div>
                    <div class="Furniture_category" id="<?php print($i);
                                                        $i++; ?>"><?php echo $row_RecBoard['item_category'] ?></div>
                    <div style="float:left;">商品狀態:</div>
                    <div class="Furniture_condition" id="<?php print($y);
                                                            $y++; ?>"><?php echo $row_RecBoard['item_status'] ?></div>
                    <div class="Furniture_detial">商品描述:<?php echo $row_RecBoard['item_describe'] ?></div>
                    <div class="Furniture_stock">是否售出:<?php echo $row_RecBoard['item_exist'] ?></div>
                    <div class="Furniture_connect">賣家聯絡資訊:<?php echo $row_RecBoard['item_seller'] ?></div>
                    <div class="Furniture_map"><iframe width="250" height="100" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCJV5RRUq0jP31bq2jSsyAinPaRhG91MSk&q=<?php echo $row_RecBoard['item_location'] ?>" allowfullscreen>
                        </iframe></div>
                </div>
            <?php } ?>

        </div>



    </div>
    <!-- -------------------------------------------------------------------------- -->
    <div class="footer">
        <P>© 2021 THE KING OF FURNITURE</P>
    </div>
</body>

</html>