<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

namespace MediaWiki\Extension\RobloxAPI\util;

/**
 * Provides utilities for working with the Roblox API.
 */
class RobloxAPIUtil {

	/**
	 * Checks whether a numeric ID is valid.
	 * @param string|null $string
	 * @return bool
	 */
	public static function isValidId( ?string $string ): bool {
		if ( $string === null ) {
			// TODO handle this somewhere else
			return false;
		}

		return preg_match( '/^\d{1,16}$/', $string );
	}

	/**
	 * Checks whether multiple numeric IDs are valid.
	 * @param array $strings
	 * @return bool
	 */
	public static function areValidIds( array $strings ): bool {
		foreach ( $strings as $string ) {
			if ( !self::isValidId( $string ) ) {
				return false;
			}
		}

		return true;
	}

}
