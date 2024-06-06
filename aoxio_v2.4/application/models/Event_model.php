<?php
class Event_model extends CI_Model {

    function get_tickets_by_event($event_id)
    {
        $this->db->select();
        $this->db->from('event_ticket');
        $this->db->where('event_id', $event_id);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

     function delete_event_tickets($event_id, $table){
        $this->db->delete($table, array('event_id' => $event_id));
        return;
    }

    function get_all_event_tickets($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('user_id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    function get_company_events($business_id)
    {
        $this->db->select('*');
        $this->db->from('events');
        $this->db->where('business_id', $business_id);
        $this->db->where('date >=', date('Y-m-d'));
        $this->db->where('status', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    function get_event_slug_by_company($slug, $table, $business_id)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('slug', $slug);
        $this->db->where('business_id', $business_id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    function get_event_booking_by_id_md5($booking_id)
    {
        $this->db->select();
        $this->db->from('event_booking');
        $this->db->where('md5(id)', $booking_id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    function get_event_bookings($user_id, $total, $limit, $offset)
    {
        $this->db->select('b.*,');
        $this->db->from('event_booking b');
        $this->db->join('events e', 'e.id = b.event_id', 'LEFT');
        $this->db->join('customers c', 'c.id = b.customer_id', 'LEFT');
        $this->db->where('b.user_id', $user_id);
        $this->db->where('b.business_id', $this->business->uid);


        if (isset($_GET['event_range']) && $_GET['event_range'] != 0) {
            $this->db->where('b.date >= ', date('Y-m-d'));
            $this->db->where('b.date <= ', $_GET['event_range']);
        }


        if (isset($_GET['event']) && $_GET['event'] != '') {
            $this->db->where('b.event_id', $_GET['event']);
        }

        if (isset($_GET['customer']) && $_GET['customer'] != '') {
            $this->db->where('b.customer_id', $_GET['customer']);
        }

        if (isset($_GET['status']) && $_GET['status'] != '') {
            $this->db->where('b.status', $_GET['status']);
        }

        if (isset($_GET['search']) && $_GET['search'] != '') {
            $this->db->like('e.name', $_GET['search']);
            $this->db->or_like('c.name', $_GET['search']);
        }



        $this->db->order_by('id', 'ASC');
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }


    function get_count_event_booking_by_status($status)
    {
        $this->db->select('count(e.id) as total');
        $this->db->from('event_booking e');
        if ($status != 'all') {
            $this->db->where('e.status', $status);
        }
        $this->db->where('e.user_id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->row();
        if (!empty($query)) {
            return $query->total;
        } else {
            return 0;
        }
    }


    function get_customer_events()
    {

        $this->db->select('e.*, ev.name as event_name, ev.date, ev.time, t.name as ticket_name, t.price, c.name as customer_name, c.email as customer_email, c.phone as customer_phone, b.name as business_name');
        $this->db->from('event_booking e');
        $this->db->join('events ev', 'ev.id = e.event_id', 'LEFT');
        $this->db->join('event_ticket t', 't.id = e.ticket_id', 'LEFT');
        $this->db->join('customers c', 'c.id = e.customer_id', 'LEFT');
        $this->db->join('business b', 'b.uid = e.business_id', 'LEFT');
        $this->db->where('e.customer_id', $this->session->userdata('id'));
        $this->db->where('e.status !=', 2);

        if (isset($_GET['daterange']) && $_GET['daterange'] != '') {
            $date = explode('-',trim($_GET['daterange']));
            if ($date[0] != $date[1]) {
                $this->db->where('e.date >=', date("Y-m-d", strtotime($date[0])));
                $this->db->where('e.date <=', date("Y-m-d", strtotime($date[1])));
            }
        }
        $this->db->order_by('e.id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    function get_single_customer_events($customer_id, $limit)
    {
        $this->db->select('e.*, ev.name as event_name, t.price, c.name as customer_name, c.email as customer_email, c.thumb as customer_thumb, c.phone as customer_phone');
        $this->db->from('event_booking e');
        $this->db->join('events ev', 'ev.id = e.event_id', 'LEFT');
        $this->db->join('customers c', 'c.id = e.customer_id', 'LEFT');
        $this->db->join('event_ticket t', 't.id = e.ticket_id', 'LEFT');
        $this->db->join('event_venue v', 'v.id = e.venue_id', 'LEFT');
        $this->db->where('e.customer_id', $customer_id);
        $this->db->where('e.business_id', $this->business->uid);
        $this->db->limit($limit);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

}