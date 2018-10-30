<?php
namespace AL\Common\DAO;

require_once __DIR__."/../../lib/Db.php" ;
require_once __DIR__."/../Model/Dump/Dump.php" ;
require_once __DIR__."/../../vendor/pclzip/pclzip/pclzip.lib.php" ;

/**
 * DAO for Dump
 */
class DumpDAO {
    private $mysqli;
    
    const FORMAT_STX = 'STX';
    const FORMAT_MSA = 'MSA';
    const FORMAT_RAW = 'RAW';
    const FORMAT_SCP = 'SCP';

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }
    
    /**
     * Get all the formats
     * @return String[] A list of formats
     */
    public function getFormats() {
        return array(
            DumpDAO::FORMAT_STX,
            DumpDAO::FORMAT_MSA,
            DumpDAO::FORMAT_RAW,
            DumpDAO::FORMAT_SCP
        );
    }
    
     /**
     * Add a dump to a media
     *
     * @param int media_id
     * @param varchar format
     * @param varchar file name
     * @param text info
     */
    public function addDumpToMedia(
        $media_id,
        $format,
        $file_name,
        $tempfilename,
        $info,
        $game_file_temp_path,
        $game_file_path,
        $filesize
    ) {
        
        // Time for zip magic
        $zip = new \PclZip("$tempfilename");

        // Obtain the contentlist of the zip file.
        if (($list = $zip->listContent()) == 0) {
            die("Error : " . $zip->errorInfo(true));
        }

        // Get the filename from the returned array
        $filename = $list[0]['filename'];

        // Split the filename to get the extention
        $ext = strrchr($filename, ".");

        // Get rid of the . in the extention
        $ext = explode(".", $ext);

        // convert to lowercase just incase....
        $ext = strtolower($ext[1]);

        // check if the extention is valid.
        if ($ext == "stx" || $ext == "msa" || $ext == "st") { // pretty isn't it? ;)
        } else {
            exit("Try uploading a diskimage type that is allowed, like stx or msa not $ext");
        }
        
        //Compare the extension with the format
        //if ($ext == $format) {
        //} else {
        //    exit("The selected format is not the same as the uploaded file");
        //}
        
        // create a timestamp for the date of upload
        $timestamp = time();
        
        $stmt = \AL\Db\execute_query(
            "DumpDAO: addDumptoMedia",
            $this->mysqli,
            "INSERT INTO dump (`media_id`, `format`, `info`, `date`, `size` ) VALUES (?, ?, ?, ?, ?)",
            "issii", $media_id, $format, $info, $timestamp, $filesize
        );
        
        //get the new dump id
        $new_dump_id = $this->mysqli->insert_id;
        
        // Time to unzip the file to the temporary directory
        $archive = new \PclZip("$tempfilename");

        if ($archive->extract(PCLZIP_OPT_PATH, "$game_file_temp_path") == 0) {
            die("Error : " . $archive->errorInfo(true));
        }

        // rename diskimage to increment number
        rename("$game_file_temp_path$filename", "$game_file_temp_path$new_dump_id.$ext")
            or die("couldn't rename the file");

        //Time to rezip file and place it in the proper location.
        $archive = new \PclZip("$game_file_path$new_dump_id.zip");
        $v_list  = $archive->create("$game_file_temp_path$new_dump_id.$ext", PCLZIP_OPT_REMOVE_ALL_PATH);
        if ($v_list == 0) {
            die("Error : " . $archive->errorInfo(true));
        }

        // Time to do the safeties, here we do a sha512 file hash that we later enter into
        // the database, this will be used in the download function to check everytime the file
        // is being downloaded... if the hashes don't match, then datacorruption have changed the file.
        $crc = openssl_digest("$game_file_path$new_dump_id.zip", 'sha512');
        
        $stmt = \AL\Db\execute_query(
            "DumpDAO: addDumptoMedia",
            $this->mysqli,
            "UPDATE dump SET sha512 = ? WHERE id = ?",
            "si", $crc, $new_dump_id
        );
        
        // Chmod file so that we can backup/delete files through ftp.
        chmod("$game_file_path$new_dump_id.zip", 0777);

        // Delete the unzipped file in the temporary directory
        unlink("$game_file_temp_path$new_dump_id.$ext");
        
        $stmt->close();
    }
    
    /**
     * Get all dumps from media
     *
     * @return \AL\Common\Model\Dump\Dump[] An array of dumps
     */
    public function getAllDumpsFromMedia($media_id) {
        $stmt = \AL\Db\execute_query(
            "DumpDAO: getAllDumpsFromMedia",
            $this->mysqli,
            "SELECT id, format, date, size, info FROM dump
            WHERE media_id = ?",
            "i", $media_id
        );

        \AL\Db\bind_result(
            "DumpDAO: getAllDumpsFromMedia",
            $stmt,
            $media_id
        );

        $dump = [];
        while ($stmt->fetch()) {
            $dump[] = new \AL\Common\Model\Dump\Dump(
                $id, null, $format, null, $date, $size, $info
            );
        }

        $stmt->close();

        return $dump;
    }
}
