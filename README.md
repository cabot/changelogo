# Change logo
Simple logo changer for phpBB

## Minimum Requirements
* phpBB 3.2.0
* PHP 5.4.7

## Install
1. Download the latest release.
2. Unzip the downloaded release, and change the name of the folder to `changelogo`.
3. In the `ext` directory of your phpBB board, create a new directory named `cabot` (if it does not already exist).
4. Copy the `changelogo` folder to `/ext/cabot/` (if done correctly, you'll have the main extension class at (your forum root)/ext/cabot/changelogo/composer.json).
5. Navigate in the ACP to `Customise -> Manage extensions`.
6. Look for `Change logo` under the Disabled Extensions list, and click its `Enable` link.

## Uninstall
1. Navigate in the ACP to `Customise -> Extension Management -> Extensions`.
2. Look for `Change logo` under the Enabled Extensions list, and click its `Disable` link.
3. To permanently uninstall, click `Delete Data` and then delete the `/ext/cabot/changelogo` folder.

## Management
1. Navigate in the ACP to `Extensions -> Logo configuration`.

## License
[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)

© 2023 - cabot
