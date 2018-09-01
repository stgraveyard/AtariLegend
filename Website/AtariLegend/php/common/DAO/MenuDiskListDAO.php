<?php
namespace AL\Common\DAO;

require_once __DIR__."/../../lib/Db.php";
require_once __DIR__."/../Model/Menus/MenusDiskList.php";
require_once __DIR__."/../Model/Menus/MenuDisk.php";
require_once __DIR__."/../Model/Crew/Crew.php";
require_once __DIR__."/../Model/Individual/Individual.php";

/**
 * DAO for Comments
 */
class MenuDiskListDAO {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    /**
     * Get all the menu disks for a Menu set
     * @param integer $menu_sets_id ID of the menu set to get menu disks for
     * @return \AL\Common\Model\Menus\MenusDiskList[] An array of Menu disks
     */
    public function getMenuDisksForSet($menu_sets_id) {
        $stmt = \AL\Db\execute_query(
            "MenuDiskListDAO: getMenuDisksForSet",
            $this->mysqli,
            "SELECT
                 menu_disk.menu_sets_id,
                 menu_set.menu_sets_name,
                 menu_disk.menu_disk_id,
                 menu_disk.menu_disk_number,
                 menu_disk.menu_disk_letter,
                 menu_disk.menu_disk_version,
                 menu_disk.menu_disk_part,
                 crew.crew_id,
                 crew.crew_name,
                 individuals.ind_id,
                 individuals.ind_name,
                 menu_disk_state.state_id,
                 menu_disk_state.menu_state,
                 menu_disk_year.menu_disk_year_id,
                 menu_disk_year.menu_year,
                 menu_disk_submenu.parent_id
                 FROM menu_disk
                 LEFT JOIN menu_set ON (menu_disk.menu_sets_id = menu_set.menu_sets_id)
                 LEFT JOIN crew_menu_prod ON (menu_set.menu_sets_id = crew_menu_prod.menu_sets_id)
                 LEFT JOIN crew ON (crew_menu_prod.crew_id = crew.crew_id)
                 LEFT JOIN ind_menu_prod ON (menu_set.menu_sets_id = ind_menu_prod.menu_sets_id)
                 LEFT JOIN individuals ON (ind_menu_prod.ind_id = individuals.ind_id)
                 LEFT JOIN menu_disk_state ON ( menu_disk.state = menu_disk_state.state_id)
                 LEFT JOIN menu_disk_year ON ( menu_disk.menu_disk_id = menu_disk_year.menu_disk_id)
                 LEFT JOIN menu_disk_submenu ON ( menu_disk.menu_disk_id = menu_disk_submenu.menu_disk_id)
                 WHERE menu_disk.menu_sets_id = ?
                 ORDER BY menu_disk_number, menu_disk_letter, menu_disk_part, menu_disk_version ASC",
            "i",
            $menu_sets_id
        );

        \AL\Db\bind_result(
            "MenuDiskListDAO: getMenuDisksForSet",
            $stmt,
            $menu_sets_id,
            $menu_sets_name,
            $menu_disk_id,
            $menu_disk_number,
            $menu_disk_letter,
            $menu_disk_version,
            $menu_disk_part,
            $crew_id,
            $crew_name,
            $ind_id,
            $ind_name,
            $state_id,
            $menu_state,
            $menu_disk_year_id,
            $menu_year,
            $parent_id
        );

        $menudisks = [];
        while ($stmt->fetch()) {
            $menudisks[] = new \AL\Common\Model\Menus\MenusDiskList(
                $menu_sets_id,
                $menu_sets_name,
                $menu_disk_name = new \AL\Common\Model\Menus\MenuDisk(
                    $menu_disk_id,
                    $menu_sets_name,
                    $menu_disk_number,
                    $menu_disk_letter,
                    $menu_disk_part,
                    $menu_disk_version
                ),
                ($crew_id != null)
                    ? new \AL\Common\Model\Crew\Crew($crew_id, $crew_name)
                    : null,
                ($ind_id != null)
                    ? new \AL\Common\Model\Individual\Individual($ind_id, $ind_name)
                    : null,
                $state_id,
                $menu_state,
                $menu_disk_year_id,
                $menu_year,
                $parent_id
            );
        }

        $stmt->close();

        return $menudisks;
    }
}