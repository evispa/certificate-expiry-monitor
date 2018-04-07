<?php
// Copyright (C) 2016 Remy van Elst

// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU Affero General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU Affero General Public License for more details.

// You should have received a copy of the GNU Affero General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.

function env_var($name, $fallback = null)
{
   return array_key_exists($name, $_ENV) ? $_ENV[$name] : $fallback;
}

$version = 1.3;
$title = env_var('CEM_TITLE','Certificate Expiry Monitor');

$current_folder = get_current_folder();

# timeout in seconds
$timeout = (int)env_var('CEM_TIMEOUT',2);

date_default_timezone_set(env_var('CEM_TIMEZONE','UTC'));

ini_set('default_socket_timeout', $timeout);

$random_blurp = rand(1000,99999);

$current_domain = env_var('CEM_DOMAIN', 'certificatemonitor.org');
$current_link = env_var('CEM_LINK', 'certificatemonitor.org');

$slack_webhook = env_var('CEM_SLACK_WEBHOOK', '');

// set this to a location outside of your webroot so that it cannot be accessed via the internets.

$pre_check_file = env_var('CEM_PRE_CHECK_FILE','/home/certmon/domains/certificatemonitor.org/cert-monitor/pre_checks.json');
$check_file = env_var('CEM_CHECK_FILE','/home/certmon/domains/certificatemonitor.org/cert-monitor/checks.json');
$deleted_check_file = env_var('CEM_DELETED_CHECK_FILE', '/home/certmon/domains/certificatemonitor.org/cert-monitor/deleted_checks.json');
