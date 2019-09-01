# 定义一个工具函数，方便后面配置各种测试选项
function pgset() {
    local result
    echo $1 > $PGDEV

    result=`cat $PGDEV | fgrep "Result: OK:"`
    if [ "$result" = "" ]; then
         cat $PGDEV | fgrep Result:
    fi
}

# 为 0 号线程绑定 eth0 网卡
PGDEV=/proc/net/pktgen/kpktgend_0
pgset "rem_device_all"   # 清空网卡绑定
pgset "add_device enp4s0"  # 添加 eth0 网卡

# 配置 eth0 网卡的测试选项
PGDEV=/proc/net/pktgen/enp4s0
pgset "count 1000000"    # 总发包数量
pgset "delay 5000"       # 不同包之间的发送延迟 (单位纳秒)
pgset "clone_skb 0"      # SKB 包复制
pgset "pkt_size 64"      # 网络包大小
pgset "dst 192.168.21.99" # 目的 IP
pgset "dst_mac 11:11:11:11:11:11"  # 目的 MAC

# 启动测试
PGDEV=/proc/net/pktgen/pgctrl
pgset "start"
