<?php

return [
		'user-management' => [		'title' => 'User management',		'fields' => [		],	],
		'roles' => [		'title' => 'Roles',		'fields' => [			'title' => 'Title',			'price' => 'Price',			'stripe-plan-id' => 'Stripe Plan ID',		],	],
		'users' => [		'title' => 'Users',		'fields' => [			'name' => 'Name',			'email' => 'Email',			'password' => 'Password',			'role' => 'Role',			'remember-token' => 'Remember token',			'team' => 'Team',			'stripe-customer-id' => 'Stripe Customer ID',			'role-until' => 'Role Until',		],	],
		'user-actions' => [		'title' => 'User actions',		'created_at' => 'Hora',		'fields' => [			'user' => 'User',			'action' => 'Action',			'action-model' => 'Action model',			'action-id' => 'Action id',			'created-by' => 'Created by',			'created-by-team' => 'Created by Team',		],	],
		'time-management' => [		'title' => 'Time management',		'fields' => [		],	],
		'time-work-types' => [		'title' => 'Work types',		'fields' => [			'name' => 'Name',		],	],
		'time-projects' => [		'title' => 'Time projects',		'fields' => [			'name' => 'Name',		],	],
		'time-entries' => [		'title' => 'Time entries list',		'fields' => [			'work-type' => 'Work type',			'population' => 'Population',			'student' => 'Student(s)',			'description' => 'Description',			'start-time' => 'Start time',			'end-time' => 'End time',			'notes' => 'Notes',			'created-by' => 'Created by',			'created-by-team' => 'Created by Team',			'caseload-student' => 'Caseload student',		],	],
		'time-reports' => [		'title' => 'Reports',		'fields' => [		],	],
		'faq-management' => [		'title' => 'FAQ Management',		'fields' => [		],	],
		'faq-categories' => [		'title' => 'Categories',		'fields' => [		],	],
		'faq-questions' => [		'title' => 'Questions',		'fields' => [		],	],
		'internal-notifications' => [		'title' => 'Notifications',		'fields' => [		],	],
		'populations' => [		'title' => 'Populations',		'fields' => [		],	],
		'calendar-entries' => [		'title' => 'Calendar entries',		'fields' => [		],	],
		'teams' => [		'title' => 'Teams',		'fields' => [		],	],
		'teams' => [		'title' => 'Teams',		'fields' => [		],	],
		'teams' => [		'title' => 'Teams',		'fields' => [			'name' => 'Name',		],	],
		'students' => [		'title' => 'Students',		'fields' => [			'identifier' => 'Identifier',			'created-by' => 'Created by',			'created-by-team' => 'Created by Team',		],	],
		'admin-settings' => [		'title' => 'Admin settings',		'fields' => [		],	],
		'reports' => [		'title' => 'Reports',		'fields' => [		],	],
		'time-populations' => [		'title' => 'Population types',		'fields' => [			'name' => 'Name',		],	],
		'faq-management' => [		'title' => 'FAQ Management',		'fields' => [		],	],
		'faq-categories' => [		'title' => 'Categories',		'fields' => [		],	],
		'faq-questions' => [		'title' => 'Questions',		'fields' => [		],	],
		'content-management' => [		'title' => 'Content management',		'fields' => [		],	],
		'content-categories' => [		'title' => 'Categories',		'fields' => [			'title' => 'Category',			'slug' => 'Slug',		],	],
		'content-tags' => [		'title' => 'Tags',		'fields' => [			'title' => 'Tag',			'slug' => 'Slug',		],	],
		'content-pages' => [		'title' => 'Pages',		'fields' => [			'title' => 'Title',			'category-id' => 'Categories',			'tag-id' => 'Tags',			'page-text' => 'Text',			'excerpt' => 'Excerpt',			'featured-image' => 'Featured image',		],	],
		'system-admin' => [		'title' => 'System admin',		'fields' => [		],	],
		'subscriptions' => [		'title' => 'Subscriptions',		'fields' => [		],	],
		'payments' => [		'title' => 'Payments',		'fields' => [			'user' => 'User',			'role' => 'Role',			'payment-amount' => 'Amount',		],	],
	'qa_create' => 'Crear',
	'qa_save' => 'Guardar',
	'qa_edit' => 'Editar',
	'qa_view' => 'Ver',
	'qa_update' => 'Actualizar',
	'qa_list' => 'Listar',
	'qa_no_entries_in_table' => 'No hay entradas en la tabla',
	'qa_custom_controller_index' => 'Índice de controlador personalizado.',
	'qa_logout' => 'Salir',
	'qa_add_new' => 'Agregar',
	'qa_are_you_sure' => 'Estás seguro?',
	'qa_back_to_list' => 'Regresar a la lista?',
	'qa_dashboard' => 'Tablero de control',
	'qa_delete' => 'Eliminar',
	'qa_restore' => 'Restaurar',
	'qa_permadel' => 'Borrar permanentemente',
	'qa_all' => 'Todos',
	'qa_trash' => 'Papelera',
	'qa_delete_selected' => 'Eliminar seleccionado',
	'qa_category' => 'Categoría',
	'qa_categories' => 'Categorias',
	'qa_title' => 'Título',
	'qa_roles' => 'Roles',
	'qa_role' => 'Rol',
	'qa_user_management' => 'Gestión de usuarios',
	'qa_users' => 'Usuarios',
	'qa_user' => 'Usuario',
	'qa_name' => 'Nombre',
	'qa_email' => 'Correo',
	'qa_password' => 'Contraseña',
	'qa_remember_token' => 'Recordar token',
	'qa_permissions' => 'Permisos',
	'qa_client' => 'Cliente',
	'qa_current_password' => 'Contraseña actual',
	'qa_new_password' => 'Contraseña nueva',
	'qa_password_confirm' => 'Confirmación de contraseña nueva',
	'qa_dashboard_text' => 'Ha iniciado sesión',
	'qa_forgot_password' => 'Olvidó su contraseña?',
	'qa_remember_me' => 'Recuerdame',
	'qa_login' => 'Iniciar sesión',
	'qa_copy' => 'Copiar',
	'qa_reset_password' => 'Reiniciar contraseña',
	'qa_email_greet' => 'Hola',
	'qa_confirm_password' => 'Confirma el password',
	'qa_please_select' => 'Por favor seleccione',
	'qa_questions' => 'Preguntas',
	'qa_question' => 'Pregunta',
	'qa_answer' => 'Respuesta',
	'qa_project' => 'Proyecto',
	'qa_expenses' => 'Gastos',
	'qa_expense' => 'Gasto',
	'qa_amount' => 'Cantidad',
	'qa_address' => 'Dirección',
	'qa_contacts' => 'Contactos',
	'qa_first_name' => 'Nombre de pila',
	'qa_last_name' => 'Apellido',
	'qa_phone' => 'Teléfono',
	'qa_category_name' => 'Nombre de la categoría',
	'qa_products' => 'Productos',
	'qa_product_name' => 'Nombre de producto',
	'qa_price' => 'Precio',
	'qa_tag' => 'Etiqueta',
	'qa_photo1' => 'Foto1',
	'qa_photo2' => 'Foto2',
	'qa_photo3' => 'Foto3',
	'qa_calendar' => 'Calendario',
	'qa_tasks' => 'Tareas',
	'qa_status' => 'Estado',
	'qa_messages' => 'Mensajes',
	'qa_you_have_no_messages' => 'No tienes mensajes.',
	'qa_all_messages' => 'Todos los mensajes',
	'qa_new_message' => 'Nouveau message',
	'qa_change_password' => 'Cambiar contraseña',
	'qa_csv' => 'CSV',
	'qa_print' => 'Imprimir',
	'qa_excel' => 'Excel',
	'qa_colvis' => 'Visibilidad de columnas',
	'qa_pdf' => 'PDF',
	'qa_register' => 'Registrarse',
	'qa_registration' => 'Registración',
	'qa_not_approved_p' => 'La cuenta no ha sido aprovada por el Administrador. Por favor, sea paciente e intentelo nuevamente.',
	'qa_whoops' => 'Whoops!',
	'qa_serial_number' => 'Número de serie',
	'qa_text' => 'Texto',
	'qa_show' => 'Mostrar',
	'qa_sample_category' => 'Ejemplo Categoria',
	'qa_sample_question' => 'FAQ (Preguntas y Respuestas)',
	'qa_sample_answer' => 'Respuesta Simple',
	'qa_user_actions' => 'Acciones de Usuario (Traza)',
	'qa_action' => 'Acciones',
	'qa_description' => 'Descrcipción',
	'qa_valid_from' => 'Válida desde',
	'qa_valid_to' => 'Válido hasta',
	'qa_discount_amount' => 'Importe de descuento',
	'qa_discount_percent' => 'Porcentaje de descuento',
	'qa_coupons_amount' => 'Cantidad de cupones',
	'qa_coupons' => 'Cupones',
	'qa_code' => 'Código',
	'qa_redeem_time' => 'Canjear tiempo',
	'qa_coupon_management' => 'Gestión de cupones',
	'qa_time_management' => 'Gestión del tiempo',
	'qa_projects' => 'Proyectos',
	'qa_reports' => 'Informes',
	'qa_time_entries' => 'Entradas de tiempo',
	'qa_work_type' => 'Tipo de trabajo',
	'qa_start_time' => 'Tiempo de Inicio',
	'qa_end_time' => 'Hora de finalización',
	'qa_expense_category' => 'Categoría de gastos',
	'qa_expense_management' => 'Administración de gastos',
	'qa_entry_date' => 'Fecha de entrada',
	'qa_monthly_report' => 'Reporte mensual',
	'qa_companies' => 'Compañias',
	'qa_company_name' => 'Nombre de la Compañia',
	'qa_website' => 'Sitio web',
	'qa_contact_management' => 'Contactos Administracion',
	'qa_company' => 'Compañia',
	'qa_photo' => 'Foto(max 8mb)',
	'qa_product_management' => 'Gestión del producto',
	'qa_tags' => 'Etiquetas',
	'qa_statuses' => 'Estados',
	'qa_task_management' => 'Administración de tareas',
	'qa_attachment' => 'Adjunto archivo',
	'qa_due_date' => 'Fecha de vencimiento',
	'qa_assigned_to' => 'Asignado A',
	'qa_assets' => 'Bienes',
	'qa_asset' => 'Activo',
	'qa_location' => 'Ubicacion',
	'qa_locations' => 'Lugar',
	'qa_assigned_user' => 'Asignado(Usuario)',
	'qa_notes' => 'Notas',
	'qa_assets_history' => 'Historia de los activos',
	'qa_assets_management' => 'Gestión de activos',
	'qa_group_by' => 'Agrupar por',
	'qa_chart_type' => 'Tipo de gráfico',
	'qa_create_new_report' => 'Crear nuevo informe',
	'qa_no_reports_yet' => 'No hay informes todavía',
	'qa_created_at' => 'Creado el',
	'qa_updated_at' => 'Actualizado el',
	'qa_deleted_at' => 'Eliminado el',
	'qa_outbox' => 'Envoyés',
	'qa_inbox' => 'Inbox',
	'qa_recipient' => 'Destinataire',
	'qa_subject' => 'Motivo',
	'qa_message' => 'Mensaje',
	'qa_send' => 'Enviar',
	'qa_reply' => 'Réplica',
	'qa_country' => 'Pais',
	'qa_file' => 'Archivo',
	'qa_income_source' => 'Fuente de ingresos',
	'qa_income_sources' => 'Fuentes de ingresos',
	'qa_budget' => 'Presupuesto',
	'qa_currency' => 'Divisa',
	'qa_email_regards' => 'Saludos',
	'qa_import_data' => 'Importar datos',
	'qa_faq_management' => 'Gestión de preguntas frecuentes',
	'qa_administrator_can_create_other_users' => 'Administrador (puede crear otros usuarios)',
	'qa_simple_user' => 'Usuario simple',
	'qa_action_model' => 'Modelo de Acción',
	'qa_action_id' => 'ID de Acción',
	'qa_time' => 'Hora',
	'qa_campaign' => 'Campaña',
	'qa_campaigns' => 'Campañas',
	'qa_work_types' => 'Tipos de trabajo',
	'qa_expense_categories' => 'Categorías de gastos',
	'qa_income_categories' => 'Categorías de ingresos',
	'qa_phone1' => 'Teléfono 1',
	'qa_phone2' => 'Teléfono 2',
	'qa_content_management' => 'Gestión de contenido',
	'qa_excerpt' => 'Extracto',
	'qa_featured_image' => 'Foto principal',
	'qa_pages' => 'Paginas',
	'qa_axis' => 'Eje',
	'qa_reports_x_axis_field' => 'Eje X: elija uno de los campos de fecha / hora',
	'qa_reports_y_axis_field' => 'Eje Y: elija uno de los campos numéricos',
	'qa_select_crud_placeholder' => 'Seleccione uno de sus CRUDs',
	'qa_select_dt_placeholder' => 'Seleccione uno de los campos de fecha / hora',
	'qa_aggregate_function_use' => 'Función agregada para usar',
	'qa_x_axis_group_by' => 'Grupo X-axis por',
	'qa_x_axis_field' => 'Campo del eje X (fecha / hora)',
	'qa_y_axis_field' => 'Campo del eje Y',
	'qa_integer_float_placeholder' => 'Seleccione uno de los campos enteros / flotantes',
	'qa_change_notifications_field_1_label' => 'Enviar notificación por correo electrónico al usuario',
	'qa_change_notifications_field_2_label' => 'Cuando la entrada en CRUD',
	'qa_select_users_placeholder' => 'Seleccione uno de sus usuarios',
	'qa_is_created' => 'es creado',
	'qa_is_updated' => 'esta actualizado',
	'qa_is_deleted' => 'esta borrado',
	'qa_notifications' => 'Notificaciones',
	'qa_notify_user' => 'Notificar al usuario',
	'qa_when_crud' => 'Cuando CRUD',
	'qa_create_new_notification' => 'Crear nueva notificación',
	'qa_upgrade_to_premium' => 'Actualizar a Premium',
	'qa_calendar_sources' => 'Fuentes de calendario',
	'qa_new_calendar_source' => 'Crear nueva fuente de calendario',
	'qa_crud_title' => 'Título del CRUD',
	'qa_crud_date_field' => 'Campo de fecha del CRUD',
	'qa_prefix' => 'Prefijo',
	'qa_label_field' => 'Campo de la etiqueta',
	'qa_suffix' => 'Sufijo',
	'qa_no_calendar_sources' => 'Sin fuentes de calendario todavía.',
	'qa_crud_event_field' => 'Campo de etiqueta de evento',
	'qa_create_new_calendar_source' => 'Crear una nueva fuente de calendario',
	'qa_edit_calendar_source' => 'Editar fuente de calendario',
	'qa_client_management' => 'Gestión de clientes',
	'qa_client_management_settings' => 'Configuraciones de administración del cliente',
	'qa_client_status' => 'Estado del Cliente',
	'qa_clients' => 'Clientes',
	'qa_client_statuses' => 'Estados del cliente',
	'qa_currencies' => 'Divisas',
	'qa_main_currency' => 'Divisa principal',
	'qa_documents' => 'Documentos',
	'qa_not_approved_title' => 'No estas aprovado',
	'qa_there_were_problems_with_input' => 'Hubo problemas con esta entrada',
	'qa_csvImport' => 'Importación CSV',
	'qa_csv_file_to_import' => 'Archivo CSV a importar',
	'qa_parse_csv' => 'Procesar CSV',
	'qa_imported_rows_to_table' => 'Importación de :rows filas de  la tabla :table',
	'qa_if_you_are_having_trouble' => 'Si tiene problemas para hacer clic en',
	'qa_skype' => 'skype',
	'qa_start_date' => 'Fecha inicio',
	'qa_project_status' => 'Estado del proyecto',
	'qa_transactions' => 'Actas',
	'qa_fee_percent' => 'Por ciento de tarifa',
	'qa_note_text' => 'Texto de nota',
	'qa_project_statuses' => 'Estados del proyecto',
	'qa_transaction_types' => 'Tipos de transacciones',
	'qa_transaction_type' => 'Tipo de transacción',
	'qa_transaction_date' => 'Fecha de Transacción',
	'qa_reset_password_woops' => '<strong> Whoops! </ strong> Tenemos problemas en el campo:',
	'qa_copy_paste_url_bellow' => 'botón, copie y pegue la siguiente URL en su navegador web:',
	'qa_file_contains_header_row' => '¿El archivo contiene fila de encabezado?',
	'qa_stripe_transactions' => 'Transacciones de Stripe',
	'qa_email_line1' => 'Usted está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.',
	'qa_email_line2' => 'Si no solicitó restablecer la contraseña, no se requieren más acciones.',
	'qa_subscription-billing' => 'Suscripciones',
	'qa_subscription-payments' => 'Pagos',
	'qa_basic_crm' => 'CRM básico',
	'qa_customers' => 'Clientes',
	'qa_customer' => 'Cliente',
	'qa_select_all' => 'Seleccionar todos',
	'qa_deselect_all' => 'Deseleccionar',
	'qa_slug' => 'Segmento',
	'qa_team-management' => 'Equipos',
	'qa_team-management-singular' => 'Equipo',
	'quickadmin_title' => 'SSW Tools',
];