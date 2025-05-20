'''LEAVE PAGE THIS IS JUST HERE MIGHT BE GOOGD IN THE FUTURE'''
#include <iostream>
#include <string>
#include <vector>

struct FirewallRule {
  std::string sourceIP;
  int sourcePort;
  std::string destIP;
  int destPort;
  std::string protocol;
  bool allow;
};

std::vector<FirewallRule> rules;

bool matchesRule(const FirewallRule& rule, const std::string& srcIP, int srcPort, const std::string& dstIP, int dstPort, const std::string& protocol) {
    return (rule.sourceIP == "*" || rule.sourceIP == srcIP) &&
           (rule.sourcePort == -1 || rule.sourcePort == srcPort) &&
           (rule.destIP == "*" || rule.destIP == dstIP) &&
           (rule.destPort == -1 || rule.destPort == dstPort) &&
           (rule.protocol == "*" || rule.protocol == protocol);
}

bool isAllowed(const std::string& srcIP, int srcPort, const std::string& dstIP, int dstPort, const std::string& protocol) {
    for (const auto& rule : rules) {
        if (matchesRule(rule, srcIP, srcPort, dstIP, dstPort, protocol)) {
            return rule.allow;
        }
    }
    return false; // Default deny
}

int main() {
  // Example usage
  rules.push_back({"192.168.1.100", -1, "*", 80, "TCP", true});
    
  std::string srcIP = "192.168.1.100";
  int srcPort = 50000;
  std::string dstIP = "192.168.1.200";
  int dstPort = 80;
  std::string protocol = "TCP";

  if (isAllowed(srcIP, srcPort, dstIP, dstPort, protocol)) {
      std::cout << "Packet allowed" << std::endl;
  } else {
      std::cout << "Packet blocked" << std::endl;
  }
  return 0;
}