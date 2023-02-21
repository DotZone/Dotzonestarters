'use strict';

// Initialize DataTable
let initDataTable = (method, table, datatable, url, data, columns, columnDefs, footerCallback) => {
    // Initialize DataTable
    datatable = table.DataTable({
        processing: true,
        serverSide: true,
        // dom: 'rtip',
        // ordering: false,
        ajax: {
            url: url,
            type: method,
            data: data != null ? data : {}
        },
        columns: columns != null ? [ ...columns ] : [],
        columnDefs: columnDefs != null ? [ ...columnDefs ] : [],
        footerCallback: footerCallback != null ? footerCallback : function (row, data, start, end, display) {},
        language: initDatatableLanguage(),
    });
    return datatable;
}

let handleSearchDatatable = (datatable) => {
    $('[data-datatable-filter="search"]').keyup((e) => {
        datatable.search(e.target.value).draw();
    })
}

// Specify datatable language
let initDatatableLanguage = () => {
    let language = { };
    switch (defaultLanguage) {
        case 'ar':
            language = {
                "loadingRecords": "جارٍ التحميل...",
                // "lengthMenu": "أظهر _MENU_ مدخلات",
                "zeroRecords": "لم يعثر على أية سجلات",
                "info": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                "search": "ابحث:",
                "paginate": {
                    "first": "الأول",
                    "previous": "السابق",
                    "next": "التالي",
                    "last": "الأخير"
                },
                "aria": {
                    "sortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                    "sortDescending": ": تفعيل لترتيب العمود تنازلياً"
                },
                "select": {
                    "rows": {
                        "_": "%d قيمة محددة",
                        "1": "1 قيمة محددة"
                    },
                    "cells": {
                        "1": "1 خلية محددة",
                        "_": "%d خلايا محددة"
                    },
                    "columns": {
                        "1": "1 عمود محدد",
                        "_": "%d أعمدة محددة"
                    }
                },
                "buttons": {
                    "print": "طباعة",
                    "copyKeys": "زر <i>ctrl<\/i> أو <i>⌘<\/i> + <i>C<\/i> من الجدول<br>ليتم نسخها إلى الحافظة<br><br>للإلغاء اضغط على الرسالة أو اضغط على زر الخروج.",
                    "pageLength": {
                        "-1": "اظهار الكل",
                        "_": "إظهار %d أسطر",
                        "1": "اظهار سطر واحد"
                    },
                    "collection": "مجموعة",
                    "copy": "نسخ",
                    "copyTitle": "نسخ إلى الحافظة",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pdf": "PDF",
                    "colvis": "إظهار الأعمدة",
                    "colvisRestore": "إستعادة العرض",
                    "copySuccess": {
                        "1": "تم نسخ سطر واحد الى الحافظة",
                        "_": "تم نسخ %ds أسطر الى الحافظة"
                    },
                    "createState": "تكوين حالة",
                    "removeAllStates": "ازالة جميع الحالات",
                    "removeState": "ازالة حالة",
                    "renameState": "تغيير اسم حالة",
                    "savedStates": "الحالات المحفوظة",
                    "stateRestore": "استرجاع حالة",
                    "updateState": "تحديث حالة"
                },
                "searchBuilder": {
                    "add": "اضافة شرط",
                    "clearAll": "ازالة الكل",
                    "condition": "الشرط",
                    "data": "المعلومة",
                    "logicAnd": "و",
                    "logicOr": "أو",
                    "value": "القيمة",
                    "conditions": {
                        "date": {
                            "after": "بعد",
                            "before": "قبل",
                            "between": "بين",
                            "empty": "فارغ",
                            "equals": "تساوي",
                            "notBetween": "ليست بين",
                            "notEmpty": "ليست فارغة",
                            "not": "ليست "
                        },
                        "number": {
                            "between": "بين",
                            "empty": "فارغة",
                            "equals": "تساوي",
                            "gt": "أكبر من",
                            "lt": "أقل من",
                            "not": "ليست",
                            "notBetween": "ليست بين",
                            "notEmpty": "ليست فارغة",
                            "gte": "أكبر أو تساوي",
                            "lte": "أقل أو تساوي"
                        },
                        "string": {
                            "not": "ليست",
                            "notEmpty": "ليست فارغة",
                            "startsWith": " تبدأ بـ ",
                            "contains": "تحتوي",
                            "empty": "فارغة",
                            "endsWith": "تنتهي ب",
                            "equals": "تساوي",
                            "notContains": "لا تحتوي",
                            "notStartsWith": "لا تبدأ بـ",
                            "notEndsWith": "لا تنتهي بـ"
                        },
                        "array": {
                            "equals": "تساوي",
                            "empty": "فارغة",
                            "contains": "تحتوي",
                            "not": "ليست",
                            "notEmpty": "ليست فارغة",
                            "without": "بدون"
                        }
                    },
                    "button": {
                        "0": "فلاتر البحث",
                        "_": "فلاتر البحث (%d)"
                    },
                    "deleteTitle": "حذف فلاتر",
                    "leftTitle": "محاذاة يسار",
                    "rightTitle": "محاذاة يمين",
                    "title": {
                        "0": "البحث المتقدم",
                        "_": "البحث المتقدم (فعال)"
                    }
                },
                "searchPanes": {
                    "clearMessage": "ازالة الكل",
                    "collapse": {
                        "0": "بحث",
                        "_": "بحث (%d)"
                    },
                    "count": "عدد",
                    "countFiltered": "عدد المفلتر",
                    "loadMessage": "جارِ التحميل ...",
                    "title": "الفلاتر النشطة",
                    "showMessage": "إظهار الجميع",
                    "collapseMessage": "إخفاء الجميع",
                    "emptyPanes": "لا يوجد مربع بحث"
                },
                "infoThousands": ",",
                "datetime": {
                    "previous": "السابق",
                    "next": "التالي",
                    "hours": "الساعة",
                    "minutes": "الدقيقة",
                    "seconds": "الثانية",
                    "unknown": "-",
                    "amPm": [
                        "صباحا",
                        "مساءا"
                    ],
                    "weekdays": [
                        "الأحد",
                        "الإثنين",
                        "الثلاثاء",
                        "الأربعاء",
                        "الخميس",
                        "الجمعة",
                        "السبت"
                    ],
                    "months": [
                        "يناير",
                        "فبراير",
                        "مارس",
                        "أبريل",
                        "مايو",
                        "يونيو",
                        "يوليو",
                        "أغسطس",
                        "سبتمبر",
                        "أكتوبر",
                        "نوفمبر",
                        "ديسمبر"
                    ]
                },
                "editor": {
                    "close": "إغلاق",
                    "create": {
                        "button": "إضافة",
                        "title": "إضافة جديدة",
                        "submit": "إرسال"
                    },
                    "edit": {
                        "button": "تعديل",
                        "title": "تعديل السجل",
                        "submit": "تحديث"
                    },
                    "remove": {
                        "button": "حذف",
                        "title": "حذف",
                        "submit": "حذف",
                        "confirm": {
                            "_": "هل أنت متأكد من رغبتك في حذف السجلات %d المحددة؟",
                            "1": "هل أنت متأكد من رغبتك في حذف السجل؟"
                        }
                    },
                    "error": {
                        "system": "حدث خطأ ما"
                    },
                    "multi": {
                        "title": "قيم متعدية",
                        "restore": "تراجع",
                        "info": "القيم المختارة تحتوى على عدة قيم لهذا المدخل. لتعديل وتحديد جميع القيم لهذا المدخل، اضغط او انتقل هنا، عدا ذلك سيبقى نفس القيم",
                        "noMulti": "هذا المدخل مفرد وليس ضمن مجموعة"
                    }
                },
                "processing": "جارٍ المعالجة...",
                "emptyTable": "لا يوجد بيانات متاحة في الجدول",
                "infoEmpty": "يعرض 0 إلى 0 من أصل 0 مُدخل",
                "thousands": ".",
                "stateRestore": {
                    "creationModal": {
                        "columns": {
                            "search": "إمكانية البحث للعمود",
                            "visible": "إظهار العمود"
                        },
                        "toggleLabel": "تتضمن",
                        "button": "تكوين الحالة",
                        "name": "اسم الحالة",
                        "order": "فرز",
                        "paging": "تصحيف",
                        "scroller": "مكان السحب",
                        "search": "بحث",
                        "searchBuilder": "مكون البحث",
                        "select": "تحديد",
                        "title": "تكوين حالة جديدة"
                    },
                    "duplicateError": "حالة مكررة بنفس الاسم",
                    "emptyError": "لا يسمح بأن يكون اسم الحالة فارغة.",
                    "emptyStates": "لا توجد حالة محفوظة",
                    "removeConfirm": "هل أنت متأكد من حذف الحالة %s؟",
                    "removeError": "لم استطع ازالة الحالة.",
                    "removeJoiner": "و",
                    "removeSubmit": "حذف",
                    "removeTitle": "حذف حالة",
                    "renameButton": "تغيير اسم حالة",
                    "renameLabel": "الاسم الجديد للحالة %s:",
                    "renameTitle": "تغيير اسم الحالة"
                },
                "autoFill": {
                    "cancel": "إلغاء الامر",
                    "fill": "املأ كل الخلايا بـ <i>%d<\/i>",
                    "fillHorizontal": "تعبئة الخلايا أفقيًا",
                    "fillVertical": "تعبئة الخلايا عموديا",
                    "info": "تعبئة تلقائية"
                },
                "decimal": ",",
                "infoFiltered": "(مرشحة من مجموع _MAX_ مُدخل)",
                "searchPlaceholder": "مثال بحث"
            }
            break;
        case 'fr':
            language = {
                "emptyTable": "Aucune donnée disponible dans le tableau",
                "loadingRecords": "Chargement...",
                "processing": "Traitement...",
                "select": {
                    "rows": {
                        "_": "%d lignes sélectionnées",
                        "1": "1 ligne sélectionnée"
                    },
                    "cells": {
                        "1": "1 cellule sélectionnée",
                        "_": "%d cellules sélectionnées"
                    },
                    "columns": {
                        "1": "1 colonne sélectionnée",
                        "_": "%d colonnes sélectionnées"
                    }
                },
                "autoFill": {
                    "cancel": "Annuler",
                    "fill": "Remplir toutes les cellules avec <i>%d<\/i>",
                    "fillHorizontal": "Remplir les cellules horizontalement",
                    "fillVertical": "Remplir les cellules verticalement"
                },
                "searchBuilder": {
                    "conditions": {
                        "date": {
                            "after": "Après le",
                            "before": "Avant le",
                            "between": "Entre",
                            "empty": "Vide",
                            "not": "Différent de",
                            "notBetween": "Pas entre",
                            "notEmpty": "Non vide",
                            "equals": "Égal à"
                        },
                        "number": {
                            "between": "Entre",
                            "empty": "Vide",
                            "gt": "Supérieur à",
                            "gte": "Supérieur ou égal à",
                            "lt": "Inférieur à",
                            "lte": "Inférieur ou égal à",
                            "not": "Différent de",
                            "notBetween": "Pas entre",
                            "notEmpty": "Non vide",
                            "equals": "Égal à"
                        },
                        "string": {
                            "contains": "Contient",
                            "empty": "Vide",
                            "endsWith": "Se termine par",
                            "not": "Différent de",
                            "notEmpty": "Non vide",
                            "startsWith": "Commence par",
                            "equals": "Égal à",
                            "notContains": "Ne contient pas",
                            "notEndsWith": "Ne termine pas par",
                            "notStartsWith": "Ne commence pas par"
                        },
                        "array": {
                            "empty": "Vide",
                            "contains": "Contient",
                            "not": "Différent de",
                            "notEmpty": "Non vide",
                            "without": "Sans",
                            "equals": "Égal à"
                        }
                    },
                    "add": "Ajouter une condition",
                    "button": {
                        "0": "Recherche avancée",
                        "_": "Recherche avancée (%d)"
                    },
                    "clearAll": "Effacer tout",
                    "condition": "Condition",
                    "data": "Donnée",
                    "deleteTitle": "Supprimer la règle de filtrage",
                    "logicAnd": "Et",
                    "logicOr": "Ou",
                    "title": {
                        "0": "Recherche avancée",
                        "_": "Recherche avancée (%d)"
                    },
                    "value": "Valeur",
                    "leftTitle": "Désindenter le critère",
                    "rightTitle": "Indenter le critère"
                },
                "searchPanes": {
                    "clearMessage": "Effacer tout",
                    "count": "{total}",
                    "title": "Filtres actifs - %d",
                    "collapse": {
                        "0": "Volet de recherche",
                        "_": "Volet de recherche (%d)"
                    },
                    "countFiltered": "{shown} ({total})",
                    "emptyPanes": "Pas de volet de recherche",
                    "loadMessage": "Chargement du volet de recherche...",
                    "collapseMessage": "Réduire tout",
                    "showMessage": "Montrer tout"
                },
                "buttons": {
                    "collection": "Collection",
                    "colvis": "Visibilité colonnes",
                    "colvisRestore": "Rétablir visibilité",
                    "copy": "Copier",
                    "copySuccess": {
                        "1": "1 ligne copiée dans le presse-papier",
                        "_": "%d lignes copiées dans le presse-papier"
                    },
                    "copyTitle": "Copier dans le presse-papier",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pageLength": {
                        "-1": "Afficher toutes les lignes",
                        "_": "Afficher %d lignes",
                        "1": "Afficher 1 ligne"
                    },
                    "pdf": "PDF",
                    "print": "Imprimer",
                    "copyKeys": "Appuyez sur ctrl ou u2318 + C pour copier les données du tableau dans votre presse-papier.",
                    "createState": "Créer un état",
                    "removeAllStates": "Supprimer tous les états",
                    "removeState": "Supprimer",
                    "renameState": "Renommer",
                    "savedStates": "États sauvegardés",
                    "stateRestore": "État %d",
                    "updateState": "Mettre à jour"
                },
                "decimal": ",",
                "datetime": {
                    "previous": "Précédent",
                    "next": "Suivant",
                    "hours": "Heures",
                    "minutes": "Minutes",
                    "seconds": "Secondes",
                    "unknown": "-",
                    "amPm": [
                        "am",
                        "pm"
                    ],
                    "months": {
                        "0": "Janvier",
                        "2": "Mars",
                        "3": "Avril",
                        "4": "Mai",
                        "5": "Juin",
                        "6": "Juillet",
                        "8": "Septembre",
                        "9": "Octobre",
                        "10": "Novembre",
                        "1": "Février",
                        "11": "Décembre",
                        "7": "Août"
                    },
                    "weekdays": [
                        "Dim",
                        "Lun",
                        "Mar",
                        "Mer",
                        "Jeu",
                        "Ven",
                        "Sam"
                    ]
                },
                "editor": {
                    "close": "Fermer",
                    "create": {
                        "title": "Créer une nouvelle entrée",
                        "button": "Nouveau",
                        "submit": "Créer"
                    },
                    "edit": {
                        "button": "Editer",
                        "title": "Editer Entrée",
                        "submit": "Mettre à jour"
                    },
                    "remove": {
                        "button": "Supprimer",
                        "title": "Supprimer",
                        "submit": "Supprimer",
                        "confirm": {
                            "_": "Êtes-vous sûr de vouloir supprimer %d lignes ?",
                            "1": "Êtes-vous sûr de vouloir supprimer 1 ligne ?"
                        }
                    },
                    "multi": {
                        "title": "Valeurs multiples",
                        "info": "Les éléments sélectionnés contiennent différentes valeurs pour cette entrée. Pour modifier et définir tous les éléments de cette entrée à la même valeur, cliquez ou tapez ici, sinon ils conserveront leurs valeurs individuelles.",
                        "restore": "Annuler les modifications",
                        "noMulti": "Ce champ peut être modifié individuellement, mais ne fait pas partie d'un groupe. "
                    },
                    "error": {
                        "system": "Une erreur système s'est produite (<a target=\"\\\" rel=\"nofollow\" href=\"\\\">Plus d'information<\/a>)."
                    }
                },
                "stateRestore": {
                    "removeSubmit": "Supprimer",
                    "creationModal": {
                        "button": "Créer",
                        "order": "Tri",
                        "paging": "Pagination",
                        "scroller": "Position du défilement",
                        "search": "Recherche",
                        "select": "Sélection",
                        "columns": {
                            "search": "Recherche par colonne",
                            "visible": "Visibilité des colonnes"
                        },
                        "name": "Nom :",
                        "searchBuilder": "Recherche avancée",
                        "title": "Créer un nouvel état",
                        "toggleLabel": "Inclus :"
                    },
                    "renameButton": "Renommer",
                    "duplicateError": "Il existe déjà un état avec ce nom.",
                    "emptyError": "Le nom ne peut pas être vide.",
                    "emptyStates": "Aucun état sauvegardé",
                    "removeConfirm": "Voulez vous vraiment supprimer %s ?",
                    "removeError": "Échec de la suppression de l'état.",
                    "removeJoiner": "et",
                    "removeTitle": "Supprimer l'état",
                    "renameLabel": "Nouveau nom pour %s :",
                    "renameTitle": "Renommer l'état"
                },
                "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                "infoEmpty": "Affichage de 0 à 0 sur 0 entrées",
                "infoFiltered": "(filtrées depuis un total de _MAX_ entrées)",
                // "lengthMenu": "Afficher _MENU_ entrées",
                "paginate": {
                    "first": "Première",
                    "last": "Dernière",
                    "next": "Suivante",
                    "previous": "Précédente"
                },
                "zeroRecords": "Aucune entrée correspondante trouvée",
                "aria": {
                    "sortAscending": " : activer pour trier la colonne par ordre croissant",
                    "sortDescending": " : activer pour trier la colonne par ordre décroissant"
                },
                "infoThousands": " ",
                "search": "Rechercher :",
                "thousands": " "
            }
            break;
        case 'es':
            language = {
                "processing": "Procesando...",
                // "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "search": "Buscar:",
                "infoThousands": ",",
                "loadingRecords": "Cargando...",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad",
                    "collection": "Colección",
                    "colvisRestore": "Restaurar visibilidad",
                    "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                    "copySuccess": {
                        "1": "Copiada 1 fila al portapapeles",
                        "_": "Copiadas %ds fila al portapapeles"
                    },
                    "copyTitle": "Copiar al portapapeles",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pageLength": {
                        "-1": "Mostrar todas las filas",
                        "_": "Mostrar %d filas"
                    },
                    "pdf": "PDF",
                    "print": "Imprimir",
                    "renameState": "Cambiar nombre",
                    "updateState": "Actualizar",
                    "createState": "Crear Estado",
                    "removeAllStates": "Remover Estados",
                    "removeState": "Remover",
                    "savedStates": "Estados Guardados",
                    "stateRestore": "Estado %d"
                },
                "autoFill": {
                    "cancel": "Cancelar",
                    "fill": "Rellene todas las celdas con <i>%d<\/i>",
                    "fillHorizontal": "Rellenar celdas horizontalmente",
                    "fillVertical": "Rellenar celdas verticalmentemente"
                },
                "decimal": ",",
                "searchBuilder": {
                    "add": "Añadir condición",
                    "button": {
                        "0": "Constructor de búsqueda",
                        "_": "Constructor de búsqueda (%d)"
                    },
                    "clearAll": "Borrar todo",
                    "condition": "Condición",
                    "conditions": {
                        "date": {
                            "after": "Despues",
                            "before": "Antes",
                            "between": "Entre",
                            "empty": "Vacío",
                            "equals": "Igual a",
                            "notBetween": "No entre",
                            "notEmpty": "No Vacio",
                            "not": "Diferente de"
                        },
                        "number": {
                            "between": "Entre",
                            "empty": "Vacio",
                            "equals": "Igual a",
                            "gt": "Mayor a",
                            "gte": "Mayor o igual a",
                            "lt": "Menor que",
                            "lte": "Menor o igual que",
                            "notBetween": "No entre",
                            "notEmpty": "No vacío",
                            "not": "Diferente de"
                        },
                        "string": {
                            "contains": "Contiene",
                            "empty": "Vacío",
                            "endsWith": "Termina en",
                            "equals": "Igual a",
                            "notEmpty": "No Vacio",
                            "startsWith": "Empieza con",
                            "not": "Diferente de",
                            "notContains": "No Contiene",
                            "notStartsWith": "No empieza con",
                            "notEndsWith": "No termina con"
                        },
                        "array": {
                            "not": "Diferente de",
                            "equals": "Igual",
                            "empty": "Vacío",
                            "contains": "Contiene",
                            "notEmpty": "No Vacío",
                            "without": "Sin"
                        }
                    },
                    "data": "Data",
                    "deleteTitle": "Eliminar regla de filtrado",
                    "leftTitle": "Criterios anulados",
                    "logicAnd": "Y",
                    "logicOr": "O",
                    "rightTitle": "Criterios de sangría",
                    "title": {
                        "0": "Constructor de búsqueda",
                        "_": "Constructor de búsqueda (%d)"
                    },
                    "value": "Valor"
                },
                "searchPanes": {
                    "clearMessage": "Borrar todo",
                    "collapse": {
                        "0": "Paneles de búsqueda",
                        "_": "Paneles de búsqueda (%d)"
                    },
                    "count": "{total}",
                    "countFiltered": "{shown} ({total})",
                    "emptyPanes": "Sin paneles de búsqueda",
                    "loadMessage": "Cargando paneles de búsqueda",
                    "title": "Filtros Activos - %d",
                    "showMessage": "Mostrar Todo",
                    "collapseMessage": "Colapsar Todo"
                },
                "select": {
                    "cells": {
                        "1": "1 celda seleccionada",
                        "_": "%d celdas seleccionadas"
                    },
                    "columns": {
                        "1": "1 columna seleccionada",
                        "_": "%d columnas seleccionadas"
                    },
                    "rows": {
                        "1": "1 fila seleccionada",
                        "_": "%d filas seleccionadas"
                    }
                },
                "thousands": ".",
                "datetime": {
                    "previous": "Anterior",
                    "next": "Proximo",
                    "hours": "Horas",
                    "minutes": "Minutos",
                    "seconds": "Segundos",
                    "unknown": "-",
                    "amPm": [
                        "AM",
                        "PM"
                    ],
                    "months": {
                        "0": "Enero",
                        "1": "Febrero",
                        "10": "Noviembre",
                        "11": "Diciembre",
                        "2": "Marzo",
                        "3": "Abril",
                        "4": "Mayo",
                        "5": "Junio",
                        "6": "Julio",
                        "7": "Agosto",
                        "8": "Septiembre",
                        "9": "Octubre"
                    },
                    "weekdays": [
                        "Dom",
                        "Lun",
                        "Mar",
                        "Mie",
                        "Jue",
                        "Vie",
                        "Sab"
                    ]
                },
                "editor": {
                    "close": "Cerrar",
                    "create": {
                        "button": "Nuevo",
                        "title": "Crear Nuevo Registro",
                        "submit": "Crear"
                    },
                    "edit": {
                        "button": "Editar",
                        "title": "Editar Registro",
                        "submit": "Actualizar"
                    },
                    "remove": {
                        "button": "Eliminar",
                        "title": "Eliminar Registro",
                        "submit": "Eliminar",
                        "confirm": {
                            "_": "¿Está seguro que desea eliminar %d filas?",
                            "1": "¿Está seguro que desea eliminar 1 fila?"
                        }
                    },
                    "error": {
                        "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                    },
                    "multi": {
                        "title": "Múltiples Valores",
                        "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                        "restore": "Deshacer Cambios",
                        "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                    }
                },
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "stateRestore": {
                    "creationModal": {
                        "button": "Crear",
                        "name": "Nombre:",
                        "order": "Clasificación",
                        "paging": "Paginación",
                        "search": "Busqueda",
                        "select": "Seleccionar",
                        "columns": {
                            "search": "Búsqueda de Columna",
                            "visible": "Visibilidad de Columna"
                        },
                        "title": "Crear Nuevo Estado",
                        "toggleLabel": "Incluir:"
                    },
                    "emptyError": "El nombre no puede estar vacio",
                    "removeConfirm": "¿Seguro que quiere eliminar este %s?",
                    "removeError": "Error al eliminar el registro",
                    "removeJoiner": "y",
                    "removeSubmit": "Eliminar",
                    "renameButton": "Cambiar Nombre",
                    "renameLabel": "Nuevo nombre para %s",
                    "duplicateError": "Ya existe un Estado con este nombre.",
                    "emptyStates": "No hay Estados guardados",
                    "removeTitle": "Remover Estado",
                    "renameTitle": "Cambiar Nombre Estado"
                }
            }
            break;
        default:
            language = {
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "infoThousands": ",",
                // "lengthMenu": "Show _MENU_ entries",
                "loadingRecords": "Loading...",
                "processing": "Processing...",
                "search": "Search:",
                "zeroRecords": "No matching records found",
                "thousands": ",",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                },
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "autoFill": {
                    "cancel": "Cancel",
                    "fill": "Fill all cells with <i>%d<\/i>",
                    "fillHorizontal": "Fill cells horizontally",
                    "fillVertical": "Fill cells vertically"
                },
                "buttons": {
                    "collection": "Collection <span class='ui-button-icon-primary ui-icon ui-icon-triangle-1-s'\/>",
                    "colvis": "Column Visibility",
                    "colvisRestore": "Restore visibility",
                    "copy": "Copy",
                    "copyKeys": "Press ctrl or u2318 + C to copy the table data to your system clipboard.<br><br>To cancel, click this message or press escape.",
                    "copySuccess": {
                        "1": "Copied 1 row to clipboard",
                        "_": "Copied %d rows to clipboard"
                    },
                    "copyTitle": "Copy to Clipboard",
                    "csv": "CSV",
                    "excel": "Excel",
                    "pageLength": {
                        "-1": "Show all rows",
                        "_": "Show %d rows"
                    },
                    "pdf": "PDF",
                    "print": "Print",
                    "updateState": "Update",
                    "stateRestore": "State %d",
                    "savedStates": "Saved States",
                    "renameState": "Rename",
                    "removeState": "Remove",
                    "removeAllStates": "Remove All States",
                    "createState": "Create State"
                },
                "searchBuilder": {
                    "add": "Add Condition",
                    "button": {
                        "0": "Search Builder",
                        "_": "Search Builder (%d)"
                    },
                    "clearAll": "Clear All",
                    "condition": "Condition",
                    "conditions": {
                        "date": {
                            "after": "After",
                            "before": "Before",
                            "between": "Between",
                            "empty": "Empty",
                            "equals": "Equals",
                            "not": "Not",
                            "notBetween": "Not Between",
                            "notEmpty": "Not Empty"
                        },
                        "number": {
                            "between": "Between",
                            "empty": "Empty",
                            "equals": "Equals",
                            "gt": "Greater Than",
                            "gte": "Greater Than Equal To",
                            "lt": "Less Than",
                            "lte": "Less Than Equal To",
                            "not": "Not",
                            "notBetween": "Not Between",
                            "notEmpty": "Not Empty"
                        },
                        "string": {
                            "contains": "Contains",
                            "empty": "Empty",
                            "endsWith": "Ends With",
                            "equals": "Equals",
                            "not": "Not",
                            "notEmpty": "Not Empty",
                            "startsWith": "Starts With",
                            "notContains": "Does Not Contain",
                            "notStartsWith": "Does Not Start With",
                            "notEndsWith": "Does Not End With"
                        },
                        "array": {
                            "without": "Without",
                            "notEmpty": "Not Empty",
                            "not": "Not",
                            "contains": "Contains",
                            "empty": "Empty",
                            "equals": "Equals"
                        }
                    },
                    "data": "Data",
                    "deleteTitle": "Delete filtering rule",
                    "leftTitle": "Outdent Criteria",
                    "logicAnd": "And",
                    "logicOr": "Or",
                    "rightTitle": "Indent Criteria",
                    "title": {
                        "0": "Search Builder",
                        "_": "Search Builder (%d)"
                    },
                    "value": "Value"
                },
                "searchPanes": {
                    "clearMessage": "Clear All",
                    "collapse": {
                        "0": "SearchPanes",
                        "_": "SearchPanes (%d)"
                    },
                    "count": "{total}",
                    "countFiltered": "{shown} ({total})",
                    "emptyPanes": "No SearchPanes",
                    "loadMessage": "Loading SearchPanes",
                    "title": "Filters Active - %d",
                    "showMessage": "Show All",
                    "collapseMessage": "Collapse All"
                },
                "select": {
                    "cells": {
                        "1": "1 cell selected",
                        "_": "%d cells selected"
                    },
                    "columns": {
                        "1": "1 column selected",
                        "_": "%d columns selected"
                    }
                },
                "datetime": {
                    "previous": "Previous",
                    "next": "Next",
                    "hours": "Hour",
                    "minutes": "Minute",
                    "seconds": "Second",
                    "unknown": "-",
                    "amPm": [
                        "am",
                        "pm"
                    ],
                    "weekdays": [
                        "Sun",
                        "Mon",
                        "Tue",
                        "Wed",
                        "Thu",
                        "Fri",
                        "Sat"
                    ],
                    "months": [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December"
                    ]
                },
                "editor": {
                    "close": "Close",
                    "create": {
                        "button": "New",
                        "title": "Create new entry",
                        "submit": "Create"
                    },
                    "edit": {
                        "button": "Edit",
                        "title": "Edit Entry",
                        "submit": "Update"
                    },
                    "remove": {
                        "button": "Delete",
                        "title": "Delete",
                        "submit": "Delete",
                        "confirm": {
                            "_": "Are you sure you wish to delete %d rows?",
                            "1": "Are you sure you wish to delete 1 row?"
                        }
                    },
                    "error": {
                        "system": "A system error has occurred (<a target=\"\\\" rel=\"nofollow\" href=\"\\\">More information<\/a>)."
                    },
                    "multi": {
                        "title": "Multiple Values",
                        "info": "The selected items contain different values for this input. To edit and set all items for this input to the same value, click or tap here, otherwise they will retain their individual values.",
                        "restore": "Undo Changes",
                        "noMulti": "This input can be edited individually, but not part of a group. "
                    }
                },
                "stateRestore": {
                    "renameTitle": "Rename State",
                    "renameLabel": "New Name for %s:",
                    "renameButton": "Rename",
                    "removeTitle": "Remove State",
                    "removeSubmit": "Remove",
                    "removeJoiner": " and ",
                    "removeError": "Failed to remove state.",
                    "removeConfirm": "Are you sure you want to remove %s?",
                    "emptyStates": "No saved states",
                    "emptyError": "Name cannot be empty.",
                    "duplicateError": "A state with this name already exists.",
                    "creationModal": {
                        "toggleLabel": "Includes:",
                        "title": "Create New State",
                        "select": "Select",
                        "searchBuilder": "SearchBuilder",
                        "search": "Search",
                        "scroller": "Scroll Position",
                        "paging": "Paging",
                        "order": "Sorting",
                        "name": "Name:",
                        "columns": {
                            "visible": "Column Visibility",
                            "search": "Column Search"
                        },
                        "button": "Create"
                    }
                }
            }
    }
    return language;
}
