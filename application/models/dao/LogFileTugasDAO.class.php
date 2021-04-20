<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2020-12-04 04:50
 */
interface LogFileTugasDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return LogFileTugas 
	 */
	public function load($id);

	/**
	 * Get all records from table
	 */
	public function queryAll();
	
	/**
	 * Get all records from table ordered by field
	 * @Param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn);
	
	/**
 	 * Delete record from table
 	 * @param logFileTuga primary key
 	 */
	public function delete($id_log);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param LogFileTugas logFileTuga
 	 */
	public function insert($logFileTuga);
	
	/**
 	 * Update record in table
 	 *
 	 * @param LogFileTugas logFileTuga
 	 */
	public function update($logFileTuga);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByTime($value, $single);

	public function queryByText($value, $single);

	public function queryByFile($value, $single);

	public function queryByNilai($value, $single);

	public function queryByCatatan($value, $single);


	public function deleteByTime($value);

	public function deleteByText($value);

	public function deleteByFile($value);

	public function deleteByNilai($value);

	public function deleteByCatatan($value);


}
?>