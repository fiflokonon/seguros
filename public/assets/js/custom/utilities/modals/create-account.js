"use strict";
var KTCreateAccount = function () {
    var e, t, i, o, s, r, a = [];
    return {
        init: function () {
            (e = document.querySelector("#kt_modal_create_account")) && new bootstrap.Modal(e), t = document.querySelector("#kt_create_account_stepper"), i = t.querySelector("#kt_create_account_form"), o = t.querySelector('[data-kt-stepper-action="submit"]'), s = t.querySelector('[data-kt-stepper-action="next"]'), (r = new KTStepper(t)).on("kt.stepper.changed", (function (e) {
                3 === r.getCurrentStepIndex() ? (o.classList.remove("d-none"), o.classList.add("d-inline-block"), s.classList.add("d-none")) : 4 === r.getCurrentStepIndex() ? (o.classList.add("d-none"), s.classList.add("d-none")) : (o.classList.remove("d-inline-block"), o.classList.remove("d-none"), s.classList.remove("d-none"))
            })), r.on("kt.stepper.next", (function (e) {
                console.log("stepper.next");
                var t = a[e.getCurrentStepIndex() - 1];
                t ? t.validate().then((function (t) {
                    console.log("validated!"), "Valid" == t ? (e.goNext(), KTUtil.scrollTop()) : Swal.fire({
                        text: "Lo sentimos, parece que se han detectado algunos errores. Inténtalo de nuevo.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, lo tengo!",
                        customClass: {confirmButton: "btn btn-light"}
                    }).then((function () {
                        KTUtil.scrollTop()
                    }))
                })) : (e.goNext(), KTUtil.scrollTop())
            })), r.on("kt.stepper.previous", (function (e) {
                console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop()
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    regis_number: {
                        validators: {
                            notEmpty: {message: "Campo Obligatorio"},
                            regexp: {
                                regexp: /^[A-Za-z]{2}-\d{3}-[A-Za-z]{1,2}$/,
                                message: 'El número de registro debe tener el formato: dos letras, un guion, tres dígitos, un guion, dos letras.'
                            }
                        }},
                    model: {validators: {notEmpty: {message: "Campo Obligatorio"}}},
                    place_number: {validators: {notEmpty: {message: "Campo Obligatorio"}}},
                    category: {validators: {notEmpty: {message: "Campo Obligatorio"}}},
                    fuel_type: {validators: {notEmpty: {message: "Campo Obligatorio"}}},
                    type_car:  {validators: {notEmpty: {message: "Campo Obligatorio"}}},
                    power: {validators: {notEmpty: {message: "Campo Obligatorio"}}},
                    trailer: {validators: {notEmpty: {message: "Campo Obligatorio"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    account_team_size: {validators: {notEmpty: {message: "Time size is required"}}},
                    account_name: {validators: {notEmpty: {message: "Account name is required"}}},
                    account: {validators: {notEmpty: {message: "Account is required"}}},
                    account_plan: {validators: {notEmpty: {message: "Account plan is required"}}}
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    business_email: {
                        validators: {
                            notEmpty: {message: "Busines email is required"},
                            emailAddress: {message: "The value is not a valid email address"}
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), a.push(FormValidation.formValidation(i, {
                fields: {
                    first_name: {validators: {notEmpty: {message: "Campo Obligatorio"}}},
                    last_name: {validators: {notEmpty: {message: "Campo Obligatorio"}}},
                    phone: {validators: {notEmpty: {message: "Campo Obligatorio"}}},
                    email: {validators: {notEmpty: {message: "Campo Obligatorio"}}},
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            })), o.addEventListener("click", (function (e) {
                a[3].validate().then((function (t) {
                    console.log("validated!"), "Valid" == t ? (e.preventDefault(), o.disabled = !0, o.setAttribute("data-kt-indicator", "on"), setTimeout((function () {
                        o.removeAttribute("data-kt-indicator"), o.disabled = !1, r.goNext()
                    }), 2e3)) : Swal.fire({
                        text: "Lo sentimos, parece que se han detectado algunos errores. Inténtalo de nuevo.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok lo tengo!",
                        customClass: {confirmButton: "btn btn-light"}
                    }).then((function () {
                        KTUtil.scrollTop()
                    }))
                }))
            })), $(i.querySelector('[name="card_expiry_month"]')).on("change", (function () {
                a[3].revalidateField("card_expiry_month")
            })), $(i.querySelector('[name="card_expiry_year"]')).on("change", (function () {
                a[3].revalidateField("card_expiry_year")
            })), $(i.querySelector('[name="business_type"]')).on("change", (function () {
                a[2].revalidateField("business_type")
            }))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTCreateAccount.init()
}));
