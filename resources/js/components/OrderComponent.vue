<template>
    <div>
        <table id="datatable" class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>رقم الهاتف</th>
                        <th>نوع الشحن</th>
                        <th>منطقة الشحن</th>
                        <th>منطقة التفريغ</th>
                        <th>الحالة</th>
                        <th>تاريخ الانشاء</th>
                        <!-- <th>خيارات</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(order, index) in orders" :key="index">
                            <td>{{ order['name'] }}</td>
                            <td>{{ order['phone'] }}</td>
                            <td>{{ order['type'] }}</td>
                            <td>{{ order['from'] }}</td>
                            <td>{{ order['to'] }}</td>
                            <td>
                                status
                            </td>
                            <td>{{ order['created_at'] }}</td>
                            <!-- <td> -->
                                <!-- @permission('orders-read')
                                    <a  href="{{ route('orders.show', $order->id) }}" class="btn btn-default btn-sm">
                                        <i class="fa fa-read"> عرض</i>
                                    </a>
                                @endpermission
                                @permission('orders-update')
                                    <a  href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"> تعديل</i>
                                    </a>
                                @endpermission -->
                            <!-- </td> -->
                        </tr>
                </tbody>
            </table>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            orders : [],
        }
    },
    mounted() {
        window.Echo.channel("add-order").listen("AddOrder", e => {
        let audio = new Audio('http://soundbible.com/mp3/heavy-rain-daniel_simon.mp3');
        audio.play();
        this.fetch()
        })
    },
    methods: {
    fetch() {
        var currentUrl = window.location.search;
      axios.get("/json/orders" + currentUrl).then( ({data}) => {
        this.orders = data
        //  = orders.map(({ id, data }) => {
        //   return {
        //     title: data.title,
        //     body: data.body,
        //     action_url: data.action_url + "?notification_id=" + id
        //   };
        //});
      });
    },
  },
  beforeMount() {
    this.fetch()
  }
}
</script>