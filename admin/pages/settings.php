<base href="../">
<?php 
    $current_page = "Settings"; // Dynamically set this based on the page
?>
<?php include("header1.php"); ?>
            <!-- End of Header -->
            <!-- Content -->
            <main class="grow content pt-5" id="content" role="content">
                <!-- Container -->
                <div class="container-fixed" id="content_container">
                </div>
                <!-- End of Container -->
                <div
                    class="flex items-center flex-wrap md:flex-nowrap lg:items-end justify-between border-b border-b-gray-200 dark:border-b-coal-100 gap-3 lg:gap-6 mb-5 lg:mb-10">
                    <!-- Container -->
                    <div class="container-fixed" id="hero_container">
                        <div class="grid">
                            <div class="scrollable-x-auto">
                                <div class="menu gap-3" data-menu="true">
                                    <div class="menu-item border-b-2 border-b-transparent menu-item-active:border-b-primary menu-item-here:border-b-primary"
                                        data-menu-item-overflow="true" data-menu-item-placement="bottom-start"
                                        data-menu-item-placement-rtl="bottom-end" data-menu-item-toggle="dropdown"
                                        data-menu-item-trigger="click|lg:hover">
                                        <div class="menu-link gap-1.5 pb-2 lg:pb-4 px-2">
                                            <span
                                                class="menu-title text-nowrap text-sm text-gray-700 menu-item-active:text-primary menu-item-active:font-medium menu-item-here:text-primary menu-item-here:font-medium menu-item-show:text-primary menu-link-hover:text-primary">
                                                Account Home
                                            </span>
                                            <span class="menu-arrow">
                                                <i
                                                    class="ki-filled ki-down text-2xs text-gray-500 menu-item-active:text-primary menu-item-here:text-primary menu-item-show:text-primary menu-link-hover:text-primary">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="menu-dropdown menu-default py-2 min-w-[200px]">
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/home/get-started.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Get Started
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/home/user-profile.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        User Profile
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/home/company-profile.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Company Profile
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link"
                                                    href="html/demo1/account/home/settings-sidebar.html" tabindex="0">
                                                    <span class="menu-title">
                                                        Settings - With Sidebar
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link"
                                                    href="html/demo1/account/home/settings-enterprise.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Settings - Enterprise
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/home/settings-plain.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Settings - Plain
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/home/settings-modal.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Settings - Modal
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu-item border-b-2 border-b-transparent menu-item-active:border-b-primary menu-item-here:border-b-primary"
                                        data-menu-item-overflow="true" data-menu-item-placement="bottom-start"
                                        data-menu-item-placement-rtl="bottom-end" data-menu-item-toggle="dropdown"
                                        data-menu-item-trigger="click|lg:hover">
                                        <div class="menu-link gap-1.5 pb-2 lg:pb-4 px-2">
                                            <span
                                                class="menu-title text-nowrap text-sm text-gray-700 menu-item-active:text-primary menu-item-active:font-medium menu-item-here:text-primary menu-item-here:font-medium menu-item-show:text-primary menu-link-hover:text-primary">
                                                Billing
                                            </span>
                                            <span class="menu-arrow">
                                                <i
                                                    class="ki-filled ki-down text-2xs text-gray-500 menu-item-active:text-primary menu-item-here:text-primary menu-item-show:text-primary menu-link-hover:text-primary">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="menu-dropdown menu-default py-2 min-w-[200px]">
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/billing/basic.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Billing - Basic
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/billing/enterprise.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Billing - Enterprise
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/billing/plans.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Plans
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/billing/history.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Billing History
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu-item border-b-2 border-b-transparent menu-item-active:border-b-primary menu-item-here:border-b-primary"
                                        data-menu-item-overflow="true" data-menu-item-placement="bottom-start"
                                        data-menu-item-placement-rtl="bottom-end" data-menu-item-toggle="dropdown"
                                        data-menu-item-trigger="click|lg:hover">
                                        <div class="menu-link gap-1.5 pb-2 lg:pb-4 px-2">
                                            <span
                                                class="menu-title text-nowrap text-sm text-gray-700 menu-item-active:text-primary menu-item-active:font-medium menu-item-here:text-primary menu-item-here:font-medium menu-item-show:text-primary menu-link-hover:text-primary">
                                                Security
                                            </span>
                                            <span class="menu-arrow">
                                                <i
                                                    class="ki-filled ki-down text-2xs text-gray-500 menu-item-active:text-primary menu-item-here:text-primary menu-item-show:text-primary menu-link-hover:text-primary">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="menu-dropdown menu-default py-2 min-w-[200px]">
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/security/get-started.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Get Started
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/security/overview.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Security Overview
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link"
                                                    href="html/demo1/account/security/allowed-ip-addresses.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Allowed IP Addresses
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link"
                                                    href="html/demo1/account/security/privacy-settings.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Privacy Settings
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link"
                                                    href="html/demo1/account/security/device-management.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Device Management
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link"
                                                    href="html/demo1/account/security/backup-and-recovery.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Backup & Recovery
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link"
                                                    href="html/demo1/account/security/current-sessions.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Current Sessions
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link"
                                                    href="html/demo1/account/security/security-log.html" tabindex="0">
                                                    <span class="menu-title">
                                                        Security Log
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu-item border-b-2 border-b-transparent menu-item-active:border-b-primary menu-item-here:border-b-primary"
                                        data-menu-item-overflow="true" data-menu-item-placement="bottom-start"
                                        data-menu-item-placement-rtl="bottom-end" data-menu-item-toggle="dropdown"
                                        data-menu-item-trigger="click|lg:hover">
                                        <div class="menu-link gap-1.5 pb-2 lg:pb-4 px-2">
                                            <span
                                                class="menu-title text-nowrap text-sm text-gray-700 menu-item-active:text-primary menu-item-active:font-medium menu-item-here:text-primary menu-item-here:font-medium menu-item-show:text-primary menu-link-hover:text-primary">
                                                Members & Roles
                                            </span>
                                            <span class="menu-arrow">
                                                <i
                                                    class="ki-filled ki-down text-2xs text-gray-500 menu-item-active:text-primary menu-item-here:text-primary menu-item-show:text-primary menu-link-hover:text-primary">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="menu-dropdown menu-default py-2 min-w-[200px]">
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/members/team-starter.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Teams Starter
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/members/teams.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Teams
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/members/team-info.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Team Info
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link"
                                                    href="html/demo1/account/members/members-starter.html" tabindex="0">
                                                    <span class="menu-title">
                                                        Members Starter
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/members/team-members.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Team Members
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link"
                                                    href="html/demo1/account/members/import-members.html" tabindex="0">
                                                    <span class="menu-title">
                                                        Import Members
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/members/roles.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Roles
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link"
                                                    href="html/demo1/account/members/permissions-toggle.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Permissions - Toggler
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link"
                                                    href="html/demo1/account/members/permissions-check.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Permissions - Check
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="menu-item border-b-2 border-b-transparent menu-item-active:border-b-primary menu-item-here:border-b-primary active">
                                        <a class="menu-link gap-1.5 pb-2 lg:pb-4 px-2"
                                            href="html/demo1/account/integrations.html">
                                            <span
                                                class="menu-title text-nowrap font-medium text-sm text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-item-here:text-primary menu-item-here:font-semibold menu-item-show:text-primary menu-link-hover:text-primary">
                                                Integrations
                                            </span>
                                        </a>
                                    </div>
                                    <div
                                        class="menu-item border-b-2 border-b-transparent menu-item-active:border-b-primary menu-item-here:border-b-primary">
                                        <a class="menu-link gap-1.5 pb-2 lg:pb-4 px-2"
                                            href="html/demo1/account/notifications.html">
                                            <span
                                                class="menu-title text-nowrap font-medium text-sm text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-item-here:text-primary menu-item-here:font-semibold menu-item-show:text-primary menu-link-hover:text-primary">
                                                Notifications
                                            </span>
                                        </a>
                                    </div>
                                    <div
                                        class="menu-item border-b-2 border-b-transparent menu-item-active:border-b-primary menu-item-here:border-b-primary">
                                        <a class="menu-link gap-1.5 pb-2 lg:pb-4 px-2"
                                            href="html/demo1/account/api-keys.html">
                                            <span
                                                class="menu-title text-nowrap font-medium text-sm text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-item-here:text-primary menu-item-here:font-semibold menu-item-show:text-primary menu-link-hover:text-primary">
                                                API Keys
                                            </span>
                                        </a>
                                    </div>
                                    <div class="menu-item border-b-2 border-b-transparent menu-item-active:border-b-primary menu-item-here:border-b-primary"
                                        data-menu-item-overflow="true" data-menu-item-placement="bottom-start"
                                        data-menu-item-placement-rtl="bottom-end" data-menu-item-toggle="dropdown"
                                        data-menu-item-trigger="click|lg:hover">
                                        <div class="menu-link gap-1.5 pb-2 lg:pb-4 px-2">
                                            <span
                                                class="menu-title text-nowrap text-sm text-gray-700 menu-item-active:text-primary menu-item-active:font-medium menu-item-here:text-primary menu-item-here:font-medium menu-item-show:text-primary menu-link-hover:text-primary">
                                                More
                                            </span>
                                            <span class="menu-arrow">
                                                <i
                                                    class="ki-filled ki-down text-2xs text-gray-500 menu-item-active:text-primary menu-item-here:text-primary menu-item-show:text-primary menu-link-hover:text-primary">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="menu-dropdown menu-default py-2 min-w-[200px]">
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/appearance.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Appearance
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/invite-a-friend.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Invite a Friend
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" href="html/demo1/account/activity.html"
                                                    tabindex="0">
                                                    <span class="menu-title">
                                                        Activity
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Container -->
                </div>
                <!-- Container -->
                <div class="container-fixed">
                    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                        <div class="flex flex-col justify-center gap-2">
                            <h1 class="text-xl font-medium leading-none text-gray-900">
                                Integrations
                            </h1>
                            <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                                Enhance Workflows with Advanced Integrations.
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <a class="btn btn-sm btn-light" href="#">
                                Add New Integration
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End of Container -->
                <!-- Container -->
                <div class="container-fixed">
                    <div class="grid gap-5 lg:gap-7.5">
                        <!-- begin: cards -->
                        <div id="integrations_cards">
                            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5 lg:gap-7.5">
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0"
                                                    src="assets/media/brand-logos/jira.svg" />
                                            </div>
                                            <div class="btn btn-sm btn-icon btn-clear btn-light">
                                                <i class="ki-filled ki-exit-right-corner">
                                                </i>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <a class="text-base font-smedium text-gray-900 hover:text-primary-active"
                                                href="html/demo1/account/billing/basic.html">
                                                Jira
                                            </a>
                                            <span class="text-2sm text-gray-700">
                                                Project management for agile teams, tracking issues and tasks.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Connect
                                        </a>
                                        <div class="flex items-center gap-2.5">
                                            <div class="switch">
                                                <input checked="" name="param" type="checkbox" value="1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0"
                                                    src="assets/media/brand-logos/inferno.svg" />
                                            </div>
                                            <div class="btn btn-sm btn-icon btn-clear btn-light">
                                                <i class="ki-filled ki-exit-right-corner">
                                                </i>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <a class="text-base font-smedium text-gray-900 hover:text-primary-active"
                                                href="html/demo1/account/billing/enterprise.html">
                                                Inferno
                                            </a>
                                            <span class="text-2sm text-gray-700">
                                                Ensures healthcare app compatibility with FHIR standards.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Connect
                                        </a>
                                        <div class="flex items-center gap-2.5">
                                            <div class="switch switch-sm">
                                                <input name="param" type="checkbox" value="1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0"
                                                    src="assets/media/brand-logos/evernote.svg" />
                                            </div>
                                            <div class="btn btn-sm btn-icon btn-clear btn-light">
                                                <i class="ki-filled ki-exit-right-corner">
                                                </i>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <a class="text-base font-smedium text-gray-900 hover:text-primary-active"
                                                href="html/demo1/account/billing/plans.html">
                                                Evernote
                                            </a>
                                            <span class="text-2sm text-gray-700">
                                                Organizes personal and professional documents, ideas, tasks.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Connect
                                        </a>
                                        <div class="flex items-center gap-2.5">
                                            <div class="switch switch-sm">
                                                <input checked="" name="param" type="checkbox" value="1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0"
                                                    src="assets/media/brand-logos/gitlab.svg" />
                                            </div>
                                            <div class="btn btn-sm btn-icon btn-clear btn-light">
                                                <i class="ki-filled ki-exit-right-corner">
                                                </i>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <a class="text-base font-smedium text-gray-900 hover:text-primary-active"
                                                href="html/demo1/account/billing/history.html">
                                                Gitlab
                                            </a>
                                            <span class="text-2sm text-gray-700">
                                                DevOps platform for code control, project management, CI/CD.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Connect
                                        </a>
                                        <div class="flex items-center gap-2.5">
                                            <div class="switch switch-sm">
                                                <input checked="" name="param" type="checkbox" value="1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0"
                                                    src="assets/media/brand-logos/google-webdev.svg" />
                                            </div>
                                            <div class="btn btn-sm btn-icon btn-clear btn-light">
                                                <i class="ki-filled ki-exit-right-corner">
                                                </i>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <a class="text-base font-smedium text-gray-900 hover:text-primary-active"
                                                href="html/demo1/account/security/get-started.html">
                                                Google webdev
                                            </a>
                                            <span class="text-2sm text-gray-700">
                                                Tools for building quality web experiences, focusing on performance.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Connect
                                        </a>
                                        <div class="flex items-center gap-2.5">
                                            <div class="switch switch-sm">
                                                <input checked="" name="param" type="checkbox" value="1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0"
                                                    src="assets/media/brand-logos/invision.svg" />
                                            </div>
                                            <div class="btn btn-sm btn-icon btn-clear btn-light">
                                                <i class="ki-filled ki-exit-right-corner">
                                                </i>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <a class="text-base font-smedium text-gray-900 hover:text-primary-active"
                                                href="html/demo1/account/security/overview.html">
                                                Invision
                                            </a>
                                            <span class="text-2sm text-gray-700">
                                                Digital design platform for prototyping and design workflow.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Connect
                                        </a>
                                        <div class="flex items-center gap-2.5">
                                            <div class="switch switch-sm">
                                                <input name="param" type="checkbox" value="1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0"
                                                    src="assets/media/brand-logos/duolingo.svg" />
                                            </div>
                                            <div class="btn btn-sm btn-icon btn-clear btn-light">
                                                <i class="ki-filled ki-exit-right-corner">
                                                </i>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <a class="text-base font-smedium text-gray-900 hover:text-primary-active"
                                                href="html/demo1/account/security/allowed-ip-addresses.html">
                                                Duolingo
                                            </a>
                                            <span class="text-2sm text-gray-700">
                                                Interactive exercises for fun, effective language learning.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Connect
                                        </a>
                                        <div class="flex items-center gap-2.5">
                                            <div class="switch switch-sm">
                                                <input name="param" type="checkbox" value="1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0"
                                                    src="assets/media/brand-logos/google-analytics-2.svg" />
                                            </div>
                                            <div class="btn btn-sm btn-icon btn-clear btn-light">
                                                <i class="ki-filled ki-exit-right-corner">
                                                </i>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <a class="text-base font-smedium text-gray-900 hover:text-primary-active"
                                                href="html/demo1/account/security/privacy-settings.html">
                                                Google Analytics
                                            </a>
                                            <span class="text-2sm text-gray-700">
                                                Insights into website traffic and marketing effectiveness.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Connect
                                        </a>
                                        <div class="flex items-center gap-2.5">
                                            <div class="switch switch-sm">
                                                <input name="param" type="checkbox" value="1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end: cards -->
                        <div class="card">
                            <div class="card-body flex flex-col items-center gap-2.5 py-7.5">
                                <div class="flex justify-center p-7.5 py-9">
                                    <img alt="image" class="dark:hidden max-h-[230px]"
                                        src="assets/media/illustrations/28.svg" />
                                    <img alt="image" class="light:hidden max-h-[230px]"
                                        src="assets/media/illustrations/28-dark.svg" />
                                </div>
                                <div class="flex flex-col gap-5 lg:gap-7.5">
                                    <div class="flex flex-col gap-3 text-center">
                                        <h2 class="text-1.5xl font-semibold text-gray-900">
                                            Add New Integration
                                        </h2>
                                        <p class="text-sm text-gray-800">
                                            Explore New Integration: Expand Your Toolkit with Cutting-Edge,
                                            <br />
                                            User-Friendly Solutions Tailored for Efficient and Innovative Project
                                            Management.
                                        </p>
                                    </div>
                                    <div class="flex justify-center mb-5">
                                        <a class="btn btn-primary" href="html/demo1/network/user-cards/mini-cards.html">
                                            Start Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    FAQ
                                </h3>
                            </div>
                            <div class="card-body py-3">
                                <div data-accordion="true" data-accordion-expand-all="true">
                                    <div class="accordion-item [&:not(:last-child)]:border-b border-b-gray-200"
                                        data-accordion-item="true">
                                        <button class="accordion-toggle py-4" data-accordion-toggle="#faq_1_content">
                                            <span class="text-base text-gray-900">
                                                How is pricing determined for each plan ?
                                            </span>
                                            <i
                                                class="ki-filled ki-plus text-gray-600 text-sm accordion-active:hidden block">
                                            </i>
                                            <i
                                                class="ki-filled ki-minus text-gray-600 text-sm accordion-active:block hidden">
                                            </i>
                                        </button>
                                        <div class="accordion-content hidden" id="faq_1_content">
                                            <div class="text-gray-700 text-md pb-4">
                                                Metronic embraces flexible licensing options that empower you to choose
                                                the perfect fit for your project's needs and budget.
                                                Understanding the factors influencing each plan's pricing helps you make
                                                an informed decision.
                                                Metronic embraces flexible licensing options that empower you to choose
                                                the perfect fit for your project's needs and budget.
                                                Understanding the factors influencing each plan's pricing helps you make
                                                an informed decision.
                                                Metronic embraces flexible licensing options that empower you to choose
                                                the perfect fit for your project's needs and budget.
                                                Understanding the factors influencing each plan's pricing helps you make
                                                an informed decision
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item [&:not(:last-child)]:border-b border-b-gray-200"
                                        data-accordion-item="true">
                                        <button class="accordion-toggle py-4" data-accordion-toggle="#faq_2_content">
                                            <span class="text-base text-gray-900">
                                                What payment methods are accepted for subscriptions ?
                                            </span>
                                            <i
                                                class="ki-filled ki-plus text-gray-600 text-sm accordion-active:hidden block">
                                            </i>
                                            <i
                                                class="ki-filled ki-minus text-gray-600 text-sm accordion-active:block hidden">
                                            </i>
                                        </button>
                                        <div class="accordion-content hidden" id="faq_2_content">
                                            <div class="text-gray-700 text-md pb-4">
                                                Metronic embraces flexible licensing options that empower you to choose
                                                the perfect fit for your project's needs and budget.
                                                Understanding the factors influencing each plan's pricing helps you make
                                                an informed decision
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item [&:not(:last-child)]:border-b border-b-gray-200"
                                        data-accordion-item="true">
                                        <button class="accordion-toggle py-4" data-accordion-toggle="#faq_3_content">
                                            <span class="text-base text-gray-900">
                                                Are there any hidden fees in the pricing ?
                                            </span>
                                            <i
                                                class="ki-filled ki-plus text-gray-600 text-sm accordion-active:hidden block">
                                            </i>
                                            <i
                                                class="ki-filled ki-minus text-gray-600 text-sm accordion-active:block hidden">
                                            </i>
                                        </button>
                                        <div class="accordion-content hidden" id="faq_3_content">
                                            <div class="text-gray-700 text-md pb-4">
                                                Metronic embraces flexible licensing options that empower you to choose
                                                the perfect fit for your project's needs and budget.
                                                Understanding the factors influencing each plan's pricing helps you make
                                                an informed decision
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item [&:not(:last-child)]:border-b border-b-gray-200"
                                        data-accordion-item="true">
                                        <button class="accordion-toggle py-4" data-accordion-toggle="#faq_4_content">
                                            <span class="text-base text-gray-900">
                                                Is there a discount for annual subscriptions ?
                                            </span>
                                            <i
                                                class="ki-filled ki-plus text-gray-600 text-sm accordion-active:hidden block">
                                            </i>
                                            <i
                                                class="ki-filled ki-minus text-gray-600 text-sm accordion-active:block hidden">
                                            </i>
                                        </button>
                                        <div class="accordion-content hidden" id="faq_4_content">
                                            <div class="text-gray-700 text-md pb-4">
                                                Metronic embraces flexible licensing options that empower you to choose
                                                the perfect fit for your project's needs and budget.
                                                Understanding the factors influencing each plan's pricing helps you make
                                                an informed decision
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item [&:not(:last-child)]:border-b border-b-gray-200"
                                        data-accordion-item="true">
                                        <button class="accordion-toggle py-4" data-accordion-toggle="#faq_5_content">
                                            <span class="text-base text-gray-900">
                                                Do you offer refunds on subscription cancellations ?
                                            </span>
                                            <i
                                                class="ki-filled ki-plus text-gray-600 text-sm accordion-active:hidden block">
                                            </i>
                                            <i
                                                class="ki-filled ki-minus text-gray-600 text-sm accordion-active:block hidden">
                                            </i>
                                        </button>
                                        <div class="accordion-content hidden" id="faq_5_content">
                                            <div class="text-gray-700 text-md pb-4">
                                                Metronic embraces flexible licensing options that empower you to choose
                                                the perfect fit for your project's needs and budget.
                                                Understanding the factors influencing each plan's pricing helps you make
                                                an informed decision
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item [&:not(:last-child)]:border-b border-b-gray-200"
                                        data-accordion-item="true">
                                        <button class="accordion-toggle py-4" data-accordion-toggle="#faq_6_content">
                                            <span class="text-base text-gray-900">
                                                Can I add extra features to my current plan ?
                                            </span>
                                            <i
                                                class="ki-filled ki-plus text-gray-600 text-sm accordion-active:hidden block">
                                            </i>
                                            <i
                                                class="ki-filled ki-minus text-gray-600 text-sm accordion-active:block hidden">
                                            </i>
                                        </button>
                                        <div class="accordion-content hidden" id="faq_6_content">
                                            <div class="text-gray-700 text-md pb-4">
                                                Metronic embraces flexible licensing options that empower you to choose
                                                the perfect fit for your project's needs and budget.
                                                Understanding the factors influencing each plan's pricing helps you make
                                                an informed decision
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-2 gap-5 lg:gap-7.5">
                            <div class="card">
                                <div class="card-body px-10 py-7.5 lg:pr-12.5">
                                    <div class="flex flex-wrap md:flex-nowrap items-center gap-6 md:gap-10">
                                        <div class="flex flex-col items-start gap-3">
                                            <h2 class="text-1.5xl font-medium text-gray-900">
                                                Questions ?
                                            </h2>
                                            <p class="text-sm text-gray-800 leading-5.5 mb-2.5">
                                                Visit our Help Center for detailed assistance on billing, payments, and
                                                subscriptions.
                                            </p>
                                        </div>
                                        <img alt="image" class="dark:hidden max-h-[150px]"
                                            src="assets/media/illustrations/29.svg" />
                                        <img alt="image" class="light:hidden max-h-[150px]"
                                            src="assets/media/illustrations/29-dark.svg" />
                                    </div>
                                </div>
                                <div class="card-footer justify-center">
                                    <a class="btn btn-link" href="">
                                        Go to Help Center
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body px-10 py-7.5 lg:pr-12.5">
                                    <div class="flex flex-wrap md:flex-nowrap items-center gap-6 md:gap-10">
                                        <div class="flex flex-col items-start gap-3">
                                            <h2 class="text-1.5xl font-medium text-gray-900">
                                                Contact Support
                                            </h2>
                                            <p class="text-sm text-gray-800 leading-5.5 mb-2.5">
                                                Need assistance? Contact our support team for prompt, personalized help
                                                your queries & concerns.
                                            </p>
                                        </div>
                                        <img alt="image" class="dark:hidden max-h-[150px]"
                                            src="assets/media/illustrations/31.svg" />
                                        <img alt="image" class="light:hidden max-h-[150px]"
                                            src="assets/media/illustrations/31-dark.svg" />
                                    </div>
                                </div>
                                <div class="card-footer justify-center">
                                    <a class="btn btn-link" href="https://devs.keenthemes.com/unresolved">
                                        Contact Support
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Container -->
            </main>
            <!-- End of Content -->
            <!-- Footer -->
<?php include("footer1.php"); ?>