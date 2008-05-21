<?php
/**
 * arbit CouchDB backend
 *
 * This file is part of arbit.
 *
 * arbit is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 3 of the License.
 *
 * arbit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with arbit; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @package Core
 * @subpackage CouchDbBackend
 * @version $Revision: 349 $
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPL
 */

/**
 * Validate text inputs
 *
 * @package Core
 * @subpackage CouchDbBackend
 * @version $Revision: 349 $
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPL
 */
class arbitBackendCouchDbDocumentArrayValidator extends arbitBackendCouchDbDocumentValidator
{
    /**
     * Validate input as string
     * 
     * @param mixed $input 
     * @return string
     */
    public function validate( $input )
    {
        // We expect an array of documents, and if this isn't an array, we can
        // bail out immediatly.
        if ( !is_array( $input ) )
        {
            throw new arbitBackendCouchDbValidationException( 'Invalid document type provided.', array() );
        }

        // Reuse the document validator to validate the single documents in the
        // array.
        foreach ( $input as $key => $value )
        {
            $input[$key] = parent::validate( $value );
        }

        // If no exception has been thrown during the process, retun the valid
        // array
        return $input;
    }
}

