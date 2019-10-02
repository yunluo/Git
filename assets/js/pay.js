setCookie('wp-nocache', 1, 500);

function addcode(a, b) { //ID ， 提取码
    var ajax_data = {
        action: 'addcode',
        id: a,
        code: b,
    };
    $.post("/wp-admin/admin-ajax.php", ajax_data,
        function(c) {
            if (c == '1') {
                swal("输入成功", "您的邮箱提取码是" + b, "success");
                localStorage.setItem(a,b);
            }
        });
}

function checkpayjs(a, b) { //ID，订单号
    var ajax_data = {
        action: 'checkpayjs',
        id: a,
        orderid: b,
    };
    $.post("/wp-admin/admin-ajax.php", ajax_data,
        function(c) {
            if (c == '1') {
                swal("支付成功!", "为了方便您后续再次查看，请您输入您的常用邮箱作为提取码", "info", {
                        dangerMode: true,
                        closeOnClickOutside: false,
                        content: "input",
                    })
                    .then((d) => {
                        getcontent(a);
                        addcode(a, `${d}`);
                    }); //ok
            } else {
                swal("查看失败", "您的支付没有成功，请重试", "error");
            }
        });
}

function payjs(a, b, c) {
    var ajax_data = {
        action: 'payjs_view',
        id: a,
        money: b,
        way: c,
    };
    $.post("/wp-admin/admin-ajax.php", ajax_data,
        function(d) {
            if (d) {
                var f = document.createElement("img"),
                    e = d.split('|'),
                    g = e[2];
                    f.id = 'pqrious';
                swal("支付金额：" + e[0] + "元", {
                        content: f,
                        closeOnClickOutside: false,
                        button: "支付已完成",
                    })
                    .then((value) => {
                        checkpayjs(a, g);
                    });
                var h = new QRious({
                    element: document.getElementById("pqrious"),
                    size: 300,
                    value: e[1]
                });
            }
        });

}

function payway(a, b) { //id,money
    swal("点此开始扫码", "支持支付宝、微信，支付过程中请勿刷新页面！", "warning", {
            buttons: ["支付宝", "微信"],
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((way) => {
            if (way) { //微信
                payjs(a, b, 0);
            } else { //支付宝
                payjs(a, b, 1);
            }
        });
}


function getcontent(a) {
    var ajax_data = {
        action: 'getcontent',
        id: a
    };
    $.post("/wp-admin/admin-ajax.php", ajax_data,
        function(c) {
            if (c) {
                $("#hide_notice").hide();
                $("#hide_notice").after("<div class='content-hide-tips'><span class='rate label label-warning'>付费内容：</span><p>" + c + "</p></div>");
            }
        });
}

function checkcode(a, b) {
    var ajax_data = {
        action: 'check_code',
        id: a,
        code: b
    };
    $.post("/wp-admin/admin-ajax.php", ajax_data,
        function(c) {
            if (c == 1) {
                getcontent(a);
            } else {
                swal("查看失败", "服务器不存在此提取邮箱，请重新输入", "error");
            }
        });

}

function pay_view() {
    var id = $("#pay_view").data("id"),
        money = $("#pay_view").data("money");
    swal("查看付费内容", "如未支付，请先支付，如已支付，请点击已支付", "warning", {
            buttons: ["扫码支付", "我已支付"],
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((pay) => {
            if (pay) {
                swal("请输入您的支付提取码:", {
                        content: "input",
                        button: "验证提取码"
                    })
                    .then((code) => {
                        checkcode(id, `${code}`);
                    });
            } else {
                payway(id, money);
            }
        });
}