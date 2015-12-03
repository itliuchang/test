<?php
/**
*Reservation represents an application module.
*/
class Reservation{

	/**
	 * This is method for get all reservations list
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS',
	 *         		'data':{
	 *         			{'id':'',
	 *         			'name':'',
	 *         			'createTime':'',
	 *         			'reservationTime':'',
	 *         			...},
	 *         			{'id':'',
	 *         			'name':'',
	 *         			'createTime':'',
	 *         			'reservationTime':'',
	 *         			...}
	 *         		}
	 * }
	 */
	public function getReservationList(){
		
	}

	/**
	 * This is method for get reservations information
	 * @param  string $id 
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS',
	 *         		'data':{
	 *         			'id':'',
	 *         			'name':'',
	 *         			'createTime':'',
	 *         			'reservationTime':'',
	 *         			...
	 *         		}
	 * }
	 */
	public function getReservationInfo($id){
		
	}

	/**
	 * This is method for delete reservation from list
	 * @param  string $id 
	 * @return array[] {
	 *         		'code':200,
	 *         		'message':'SUCCESS'
	 * }
	 */
	public function deleteReservation($id){
		
	}
}
