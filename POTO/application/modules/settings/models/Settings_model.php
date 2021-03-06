<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Settings Model
 *
 * Retrieves and updates settings in the database.
 *
 * @package		Settings
 * @subpackage	Model
 * @author		codauris
 * @link		http://codauris.tk
 */

class Settings_model extends MY_Model
{
    /** @var string Name of the table. */
    protected $table_name = 'settings';

    /** @var string Name of the primary key. */
    protected $key = 'name';

    /** @var boolean Use soft deletes or not. */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var boolean Set the created time automatically on a new record. */
    protected $set_created = false;

    /** @var boolean Set the modified time automatically on editing a record. */
    protected $set_modified = false;

    /**
     * A convenience method, combines where() and find_all() into a single call.
     *
     * @param string $field The table field to search in.
     * @param string $value The value that field should be.
     * @param string $type  The type of where clause to use, either 'and' or 'or'.
     *
     * @return array
     */
    public function find_all_by($field = null, $value = null, $type = 'and')
    {
        if (empty($field)) {
            return false;
        }

        // Setup the field/value check.
        if (! is_array($field)) {
            $field = array($field => $value);
        }

        if ($type == 'or') {
            $this->db->or_where($field);
        } else {
            $this->db->where($field);
        }

        $results = $this->find_all();

        $resultArray = array();
        if (! empty($results) && is_array($results)) {
            foreach ($results as $record) {
                $resultArray[$record->name] = $record->value;
            }
        }

        return $resultArray;
    }
}
/* end /settings/models/settings_model.php */
