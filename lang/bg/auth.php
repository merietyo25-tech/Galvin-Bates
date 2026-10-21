<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'Тези данни не съвпадат с наши регистрирани данни.',
    'password' => 'Въведената парола е грешна.',
    'throttle' => 'Твърде много опити. Опитайте отново след :seconds секунди.',

    'client_login_title'  => 'Клиентска зона',
    'client_login_sub'    => 'Влезте в профила си, за да получите достъп до досиетата си',
    'client_brand_title'  => 'Вашето клиентско<br>пространство ' . site_name(),
    'client_brand_sub'    => 'Проследявайте заявките си, управлявайте профила си и получавайте достъп до всичките си документи напълно сигурно.',

    'staff_login_title'   => 'Административен портал',
    'staff_login_sub'     => 'Достъпен единствено за упълномощен персонал',
    'staff_brand_title'   => 'Администрация<br>' . site_name(),
    'staff_brand_sub'     => 'Защитен достъп до инструментите за управление, проследяване на досиета и администриране на потребители.',

    'email'               => 'Имейл адрес',
    'email_staff'         => 'Служебен имейл',
    'email_ph'            => 'vie@primer.com',
    'email_ph_staff'      => 'agent@mellenthinfinancial.online',
    'password_label'      => 'Парола',
    'remember'            => 'Запомни ме',
    'remember_staff'      => 'Остани вписан',
    'submit'              => 'Вход',
    'submit_staff'        => 'Към таблото за управление',
    'back_site'           => 'Обратно към сайта',
    'staff_portal_link'   => 'Портал за служители / администратори',
    'client_portal_link'  => 'Клиентска зона',
    'staff_restricted'    => 'Ограничен достъп — само за упълномощен персонал',
    'staff_notice'        => 'Този портал е предназначен само за служители на ' . site_name() . '. Всички влизания се записват.',
    'or_staff'            => 'Служител или администратор ли сте?',
    'or_client'           => 'Клиент ли сте?',

    'stat_clients'        => 'Доволни клиенти',
    'stat_amount'         => 'Макс. заем / досие',
    'stat_time'           => 'Гарантиран отговор',
    'stat_years'          => 'Години опит',

    'feature_secure'      => 'Криптирани данни',
    'feature_currencies'  => '6 приети валути',
    'feature_certified'   => 'Европейски лиценз',
    'feature_fast'        => 'Отговор до 24 часа',

    'role_superadmin'     => 'Супер администратор',
    'role_superadmin_sub' => 'Глобално управление и роли',
    'role_admin'          => 'Администратор',
    'role_admin_sub'      => 'Управление на досиета',

    // Identifier (email or phone)
    'identifier'          => 'Имейл или телефон',
    'identifier_ph'       => 'vashiya@imeil.com или +359...',
    'forgot_password'     => 'Забравена парола?',
    'portal_clients_only' => 'Този портал е предназначен само за клиенти.',

    // OTP page
    'otp_title'           => 'Проверка',
    'otp_heading'         => 'Код за сигурност',
    'otp_subtitle'        => 'Изпратихме 6-цифрен код на',
    'otp_enter'           => 'Въведете кода, получен по имейл',
    'otp_verify_btn'      => 'Провери',
    'otp_resend'          => 'Изпрати отново кода',
    'otp_resend_in'       => 'Изпрати отново след',
    'otp_back'            => 'Смени профила',
    'otp_verifying'       => 'Проверка в процес…',
    'otp_invalid'         => 'Грешен код. Остават ви :remaining опит(а).',
    'otp_expired'         => 'Този код е изтекъл. Заявете нов.',
    'otp_too_many'        => 'Твърде много опити. Опитайте отново след :seconds секунди.',
    'otp_resend_limit'    => 'Твърде много повторни изпращания. Опитайте отново след няколко минути.',
    'otp_send_failed'     => 'Кодът не можа да бъде изпратен. Опитайте отново.',
    'otp_session_expired' => 'Сесията е изтекла. Влезте отново.',
    'otp_resend_success'  => 'Изпратен е нов код!',

    // Compte mémorisé
    'change_account' => 'Смени профила',

    // Compte bloqué
    'account_blocked'                     => 'Профилът ви е блокиран поради твърде много неверни опити. Проверете имейла си, за да получите връзка за отблокиране.',
    'account_blocked_notified'            => 'Твърде много неверни опити. Профилът ви беше блокиран. Изпратена ви е връзка за отблокиране по имейл.',
    'account_unblocked'                   => 'Профилът ви беше успешно отблокиран. Вече можете да влезете.',
    'unblock_invalid'                     => 'Тази връзка за отблокиране е невалидна или е изтекла. Свържете се с поддръжката.',

    'account_blocked_email_subject'       => 'Вашият профил в ' . site_name() . ' беше блокиран',
    'account_blocked_email_title'         => 'Временно блокиран профил',
    'account_blocked_email_intro'         => 'Профилът ви беше временно блокиран поради няколко неуспешни опита за вход.',
    'account_blocked_email_reason_title'  => 'Защо е блокиран профилът?',
    'account_blocked_email_reason_body'   => '4 грешни OTP кода бяха въведени последователно при опит за вход в профила ви. От съображения за сигурност достъпът беше временно спрян.',
    'account_blocked_email_btn'           => 'Отблокирай моя профил',
    'account_blocked_email_fallback'      => 'Ако бутонът не работи, копирайте тази връзка в браузъра си:',
    'account_blocked_email_notice'        => 'Ако не сте инициирали тези опити, не натискайте тази връзка и се свържете незабавно с поддръжката на ' . site_name() . '.',
    'account_blocked_email_footer'        => 'Връзката е валидна 48 часа.',

    // OTP email
    'otp_email_subject'      => 'Вашият код за вход — ' . site_name(),
    'otp_email_title'        => 'Код за потвърждение',
    'otp_email_intro'        => 'Ето вашия еднократен код за вход. Не го споделяйте с никого.',
    'otp_email_code_label'   => 'Вашият код',
    'otp_email_expiry'       => 'Този код изтича след 10 минути.',
    'otp_email_notice_title' => 'Важна информация за сигурността',
    'otp_email_notice_body'  => site_name() . ' никога няма да поиска този код по телефон или съобщение. Ако не сте заявявали този код, игнорирайте този имейл.',
    'otp_email_footer'       => 'Ако не сте заявявали този код, игнорирайте този имейл.',

    // Банер за инсталиране на PWA (страници за вход)
    'pwa_install_title' => 'Инсталирайте приложението',
    'pwa_install_hint'  => 'Бърз достъп · Известия · Офлайн режим',
    'pwa_install_btn'   => 'Инсталирай',
    'pwa_ios_title'     => 'Инсталирайте приложението на ' . site_name() . ' на вашия iPhone',
    'pwa_ios_step1'     => 'Докоснете <strong>Споделяне</strong> в Safari',
    'pwa_ios_step2'     => 'Изберете <strong>На началния екран</strong>',
    'pwa_ios_step3'     => 'Докоснете <strong>Добави</strong> — готово!',
    'pwa_close'         => 'Затвори',

];
