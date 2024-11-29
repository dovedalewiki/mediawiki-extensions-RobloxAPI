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

namespace MediaWiki\Extension\RobloxAPI\parserFunction;

use MediaWiki\Extension\RobloxAPI\data\source\DataSourceProvider;
use MediaWiki\Extension\RobloxAPI\util\RobloxAPIException;

class GroupRankParserFunction extends RobloxApiParserFunction {

	public function __construct( DataSourceProvider $dataSourceProvider ) {
		parent::__construct( $dataSourceProvider );
	}

	/**
	 * Executes the parser function.
	 * @param \Parser $parser
	 * @param string $groupId
	 * @param string $userId
	 * @return string
	 * @throws RobloxAPIException
	 */
	public function exec( $parser, $groupId = '', $userId = '' ) {
		$source = $this->dataSourceProvider->getDataSource( 'groupRoles' );

		if ( !$source ) {
			throw new RobloxAPIException( 'robloxapi-error-datasource-not-found', 'groupRoles' );
		}

		$groups = $source->fetch( $userId );

		if ( !$groups ) {
			throw new RobloxAPIException( 'robloxapi-error-datasource-returned-no-data' );
		}

		if ( !is_array( $groups ) ) {
			throw new RobloxAPIException( 'robloxapi-error-unexpected-data-structure' );
		}

		foreach ( $groups as $group ) {
			if ( $group->group->id === (int)$groupId ) {
				return $group->role->name;
			}
		}

		throw new RobloxAPIException( 'robloxapi-error-user-group-not-found' );
	}

}